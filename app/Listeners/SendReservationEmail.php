<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use App\Mail\ReservationNotifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendReservationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ReservationCreated $event)
    {
        // Access the reservation from the event
        $reservation = $event->reservation;

        // Send reservation confirmation email
            $firstname = $reservation->user->firstname;
            $room_number = $reservation->room->number;
            $email = $reservation->user->email;
            Mail::to($email)->send(new ReservationNotifyEmail($firstname, $room_number));
    }
}
