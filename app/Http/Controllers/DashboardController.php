<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard')->with('rooms', Room::paginate(12));;
    }

    public function search(Request $request) {
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
        })->whereHas('type', function ($query) use ($type) {
            $query->where('id', $type);
        })->whereHas('branchAddress', function ($query) use ($city) {
            $query->where('id', $city);
        })->paginate(12);

        $parameters = $request->all();
        return view('dashboard')->with(['rooms' => $availableRooms, 'parameters' => $parameters]);
    }
}
