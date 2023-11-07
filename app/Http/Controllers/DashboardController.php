<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard')->with('rooms', Room::all());;
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
        $parts = explode(' - ', $request->daterange);
        $checkIn = $parts[0];
        $checkOut = $parts[1];

//        $roomsByType = Room::whereHas('type', function ($query) use ($type) {
//            $query->where('id', $type);
//        })->get();
//
//        $roomsByCity = $roomsByType::whereHas('branchAddress', function ($query) use ($city) {
//            $query->where('city', $city);
//        });

        // Filter rooms based on 'type' and 'city'
        $filteredRooms = Room::whereHas('type', function ($query) use ($type) {
            $query->where('id', $type);
        })->whereHas('branchAddress', function ($query) use ($city) {
            $query->where('id', $city);
        })->get();

//        $combinedRooms = $roomsByCity->get();
        return view('dashboard')->with('rooms', $filteredRooms);
    }
}
