<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function index() {
        $user = auth()->user();
        $reservations = $user->reservations;

        return view('ticket', ['reservations' => $reservations]);
    }

    public function submit(Request $request) {
        $validator = Validator::make($request->all(), [
            'reservation'=> ['required', Rule::ProhibitedIf($request->reservation == 0), 'exists:reservations,id'],
            'message'=> ['required', 'ascii'],
            'image_path' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
        ], [
           'reservation'=> 'Choose a reservation'
        ]);

        if($validator->stopOnFirstFailure()->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        //put in database

    }
}
