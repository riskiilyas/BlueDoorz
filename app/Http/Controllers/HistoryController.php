<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
