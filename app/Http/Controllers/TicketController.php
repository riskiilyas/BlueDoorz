<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $user = auth()->user();
        $reservations = $user->reservations;

        return view('ticket', ['reservations' => $reservations]);
    }

    public function submit(Request $request) {

    }
}
