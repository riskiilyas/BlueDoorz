<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OpenAdmin\Admin\Form;

class HistoryController extends Controller
{
    public function index() {

        $user = Auth::user(); // Get the authenticated user
        $reservations = $user->reservations()->with('payment', 'room')->get();

        return view('history', compact('reservations'));    }

    public function review($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('review', compact('reservation'));
    }

    public function postReview(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string'],
        ]);
        $reservation = Reservation::findOrFail($id);

        // Validation passed, store the rating
        $rating = new Rating();
        $rating->user_id = $reservation->user_id;
        $rating->reservation_id = $id;
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment');
        $rating->save();

        // Redirect with success message
        return redirect()->route('history')->with('success', 'Review submitted successfully!');
    }


    public function getReservations()
    {
        $reservations = Reservation::all();

        $monthlyIncome = array_fill(0, 12, 0); // Initialize an array with zeros for each month

        foreach ($reservations as $reservation) {
            $month = $reservation->created_at->month;

            // Assuming there's a 'amount' column in your reservations table
            $monthlyIncome[$month - 1] += $reservation->total_price;
        }
        return response()->json($monthlyIncome);
    }

    public function getTransactions()
    {
        $reservations = Reservation::all();

        $totalTransactions = array_fill(0, 12, 0);

        foreach ($reservations as $reservation) {
            $month = $reservation->created_at->month;
            $totalTransactions[$month - 1]++;
        }
        return response()->json($totalTransactions);
    }

    public function getTopProfitCities()
    {
        $topCities = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('branch_addresses', 'rooms.branch_address_id', '=', 'branch_addresses.id')
            ->select('branch_addresses.city', DB::raw('SUM(reservations.total_price) as total_profit'))
            ->groupBy('branch_addresses.city')
            ->orderByDesc('total_profit')
            ->limit(10)
            ->get();

        return response()->json($topCities);
    }

    public function getAvgRatings()
    {
        $avgRatings = DB::table('ratings')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COALESCE(AVG(rating), 0) as avg_rating')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('avg_rating', 'month');

        // Initialize all months to 0
        $allMonths = array_fill(1, 12, 0);

        // Update values for months with ratings
        foreach ($avgRatings as $month => $avgRating) {
            $allMonths[$month] = $avgRating;
        }

        // Convert associative array to indexed array
        $result = array_values($allMonths);

        return response()->json($result);
    }
}
