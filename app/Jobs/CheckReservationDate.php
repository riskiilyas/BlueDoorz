<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class CheckReservationDate implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $reservations = Reservation::all();

        foreach ($reservations as $reservation) {
            $this->handleCheckin($reservation);
            $this->handleCheckout($reservation);
        }
    }

    private function handleCheckin($reservation) {
        $checkin = $reservation->checkin;
        $threeDaysAgo = today()->subDays(3);

        if($checkin == $threeDaysAgo) {
            if($reservation->checkin_state == 'PENDING-IN') {
                $reservation->checkin_state = 'CANCELLED';
                $reservation->save();
            }
        }
    }

    private function handleCheckout($reservation) {
        $checkout = $reservation->checkout;

        if($checkout->isToday()) {
            if($reservation->checkin_state == 'IN') {
                $reservation->checkin_state = 'PENDING-OUT';
                $reservation->save();
            }
        }
        else if($checkout->isPast()) {
            if($reservation->checkin_state == 'PENDING-OUT') {
                $reservation->total_price += round($reservation->room->type->price * 0.5);
                $reservation->save();
            }
        }
    }
}
