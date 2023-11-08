<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Barang;
use App\Models\BranchAddress;
use App\Models\Role;
use App\Models\Room;
use Illuminate\Database\Seeder;
use OpenAdmin\Admin\Auth\Database\Menu;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating Users
        \App\Models\User::factory(50)->create();

        // Creating Room Types
        \App\Models\RoomType::factory()->create([
            'name' => 'Suite',
            'price' => 800_000
        ]);
        \App\Models\RoomType::factory()->create([
            'name' => 'Family Room',
            'price' => 1_500_000
        ]);
        \App\Models\RoomType::factory()->create([
            'name' => 'Presidential Suite',
            'price' => 8_000_000
        ]);
        \App\Models\RoomType::factory()->create([
            'name' => 'Deluxe Room',
            'price' => 4_000_000
        ]);
        \App\Models\RoomType::factory()->create([
            'name' => 'Basic Room',
            'price' => 350_000
        ]);

        BranchAddress::factory(20)->create();

        // Creating the Rooms
        Room::factory(250)->create();

        $imageEachRoom = 3;
        for ($i=0; $i < $imageEachRoom; $i++) $this->createRoomImageEachRooms();
    }

    public function createRoomImageEachRooms() {

        $rooms = Room::all();

        $imagePaths = [];
        for ($i = 1; $i <= 28; $i++) {
            $imagePaths[] = "/statics/room_samples/{$i}.jpg";
        }

        foreach ($rooms as $room) {
            $randomImagePath = $imagePaths[array_rand($imagePaths)];
            $room->images()->create([
                'image_path' => $randomImagePath,
            ]);
        }
    }
}
