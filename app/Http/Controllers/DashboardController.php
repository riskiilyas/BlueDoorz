<?php

namespace App\Http\Controllers;

use App\Models\PaymentBank;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard')->with('rooms', Room::paginate(12));;
    }

    public function search(Request $request)
    {
//        dd($request);
        $validator = Validator::make($request->all(), [
            'daterange' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $type = intval($request->type);
        $city = intval($request->city);

        $dateRange = explode(' - ', $request->daterange);
        $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0]);
        $endDate = Carbon::createFromFormat('d/m/Y', $dateRange[1]);

        $availableRooms = Room::whereDoesntHave('reservations', function ($query) use ($startDate, $endDate) {
            $query->where(function ($subquery) use ($startDate, $endDate) {
                // Check for reservations that intersect with the requested date range
                $subquery->where(function ($intersectQuery) use ($startDate, $endDate) {
                    $intersectQuery->where('checkin', '<', $endDate)
                        ->where('checkout', '>', $startDate);
                });
            });
        });

        if ($type != 0) {
            $availableRooms = $availableRooms->whereHas('type', function ($query) use ($type) {
                $query->where('id', $type);
            });
        }

        if ($city != 0) {
            $availableRooms = $availableRooms->whereHas('branchAddress', function ($query) use ($city) {
                $query->where('id', $city);
            });
        }


        $parameters = $request->all();
        return view('dashboard')->with(['rooms' => $availableRooms->paginate(12), 'parameters' => $parameters]);
    }

    public function room(Request $request, $id)
    {
        // Retrieve the room based on the provided ID (assuming you have a Room model)
        $room = Room::find($id);

        $parameters = $request->all();
        return view('room')->with(['room' => $room, 'parameters' => $parameters]);
    }

    public function book(Request $request, $id)
    {
        $room = Room::find($id);

        $daterange = $request->input('daterange');

        if ($daterange) {
            list($start, $end) = explode(' - ', $daterange);
            $startDate = Carbon::createFromFormat('m/d/Y', trim($start));
            $endDate = Carbon::createFromFormat('m/d/Y', trim($end));
            $numberOfDays = $endDate->diffInDays($startDate) + 1;
        } else {
            $numberOfDays = 1;
        }

        $totalPrice = $room->type->price * $numberOfDays;

        $parameters = $request->all();
        return view('booking')->with(['room' => $room, 'parameters' => $parameters, 'totalPrice' => $totalPrice, 'paymentBanks' => PaymentBank::all()]);
    }

    public function pay(Request $request, $id)
    {
//        dd($request);
        $room = Room::find($id);

        $daterange = $request->input('daterange');

        if ($daterange) {
            list($start, $end) = explode(' - ', $daterange);
            $startDate = Carbon::createFromFormat('m/d/Y', trim($start));
            $endDate = Carbon::createFromFormat('m/d/Y', trim($end));
            $numberOfDays = $endDate->diffInDays($startDate) + 1;
        } else {
            $numberOfDays = 1;
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
        }

        $totalPrice = $room->type->price * $numberOfDays;

        $validatedData = $request->validate([
            'payment_bank_id' => 'required|exists:payment_banks,id',
            'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048', // Adjust file validation rules as needed
        ]);

        // Create a new Reservation instance
        $reservation = new Reservation();
        $reservation->payment_bank_id = $validatedData['payment_bank_id'];

        // Additional fields to set
        $reservation->checkin = $startDate;
        $reservation->checkout = $endDate;
        $reservation->total_price = $totalPrice;
        $reservation->room_id = $room->id;
        $reservation->user_id = auth()->id(); // Set the user ID

        // Step 2: Save the payment_proof file
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'payment_proof/' . $filename; // Define the custom path
            $file->storeAs('public', $path); // Store the file in the 'public' disk with the custom path
            $reservation->payment_proof = $path;
        }

        // Step 3: Save the reservation to the database
        $reservation->save();

        // Redirect to the dashboard view with a success message
        Session::flash('success', 'Reservation created successfully');
        return redirect()->route('dashboard');
    }
}
