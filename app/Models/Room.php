<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms'; // Set the table name if it's different from the model's name

    protected $fillable = [
        'number',
        'type_id',
        'branch_address_id',
    ];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'type_id');
    }

    public function branchAddress()
    {
        return $this->belongsTo(BranchAddress::class, 'branch_address_id');
    }
}
