<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBank extends Model
{
    use HasFactory;

    protected $table = 'payment_banks'; // Set the table name

    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'bank_image_path',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'payment_bank_id');
    }
}
