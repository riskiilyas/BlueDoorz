<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{

    protected $table = 'room_images'; // Set the table name if it's different from the model's name

    protected $fillable = [
        'image_path',
        'room_id',
    ];

    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
