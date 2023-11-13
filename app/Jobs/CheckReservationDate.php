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
        $reservations = Reservation::where('checkin', '>=', today()->subDays(3))->get();

        foreach ($reservations as $reservation) {
            $this->handleCheckin($reservation);
            $this->handleCheckout($reservation);
        }
    }

    private function handleCheckin($reservation) {
        $checkin = Carbon::parse($reservation->checkin);
        $threeDaysAgo = today()->subDays(3);

        if($checkin == $threeDaysAgo && $reservation->checkin_state == 'PENDING-IN') {
            $reservation->update(['checkin_state' => 'CANCELLED']);
        }
    }

    private function handleCheckout($reservation) {
        $checkout = Carbon::parse($reservation->checkout);

        if(($checkout->isToday() || $checkout->isPast()) && $reservation->checkin_state == 'IN') {
            $reservation->update(['checkin_state' => 'PENDING-OUT']);
        }
        else if($checkout->isPast() && $reservation->checkin_state == 'PENDING-OUT') {
            $reservation->update(['total_price' => round($reservation->room->type->price * 0.5)]);
        }
    }
}
