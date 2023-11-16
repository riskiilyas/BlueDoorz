<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['checkin', 'checkout', 'room_id', 'user_id', 'lateness_fee'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentBank::class, 'payment_bank_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    protected $dispatchesEvents = [
        'created' => \App\Events\ReservationCreated::class,
    ];
}
