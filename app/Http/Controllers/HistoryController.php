<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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
}
