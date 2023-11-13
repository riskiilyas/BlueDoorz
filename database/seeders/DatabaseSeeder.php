<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Barang;
use App\Models\BranchAddress;
use App\Models\PaymentBank;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use OpenAdmin\Admin\Auth\Database\Menu;
use Carbon\Carbon;

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

        // Creating Branch Addresses
        BranchAddress::factory(20)->create();

        // Creating the Rooms
        Room::factory(250)->create();

        // Creating 3 Images for Each Room
        $imageEachRoom = 3;
        for ($i=0; $i < $imageEachRoom; $i++) $this->createRoomImageEachRooms();


        // Creating Payment Banks
        $bankNames = ['Bank BCA', 'Bank BNI', 'Bank BRI', 'Bank BTN', 'Bank BTPN', 'Bank Mandiri', 'Bank MEGA', 'Bank Muamalat'
            , 'Bank Sinarmas', 'Bank Syariah Mandiri', 'BTN Syariah', 'CIMB Niaga', 'Citibank', 'Danamon', 'OCBC NISP', 'Permata Bank'
        ];

        foreach ($bankNames as $bankName) {
            PaymentBank::factory()->create([
                'bank_name' => $bankName,
                'bank_image_path' => 'statics/bank/'.$bankName.'.png'
                ]);
        }

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 500; $i++) {
            $checkin = $faker->dateTimeBetween('-1 year', 'now');
            $checkout = $faker->dateTimeBetween($checkin, '+1 month');

            $roomTypeId = $faker->randomElement(\App\Models\RoomType::pluck('id'));
            $roomTypePrice = \App\Models\RoomType::where('id', $roomTypeId)->value('price');

            // Calculate the total price based on the number of days and room type's price
            $daysDifference = $checkin->diff($checkout)->days;
            $totalPrice = $roomTypePrice * $daysDifference;

            $checkin_states = ['IN','OUT','PENDING-OUT','PENDING-IN', 'CANCELLED'];

            DB::table('reservations')->insert([
                'checkin' => $checkin,
                'checkout' => $checkout,
                'payment_proof' => 'statics/sample_receipt.png',
                'total_price' => $totalPrice,
                'room_id' => $faker->randomElement(Room::pluck('id')),
                'user_id' => $faker->randomElement(\App\Models\User::pluck('id')),
                'payment_bank_id' => $faker->randomElement(PaymentBank::pluck('id')),
                'created_at' => $checkin, // Set created_at to checkin date
                'updated_at' => now(),
                'checkin_state' => (function ($checkin, $checkout, $checkin_states){
                    $now = now();
                    $checkin = Carbon::parse($checkin);
                    $checkout = Carbon::parse($checkout);

                    if($now->isBetween($checkin, $checkout)) {
                        return 'IN';
                    }
                    else if($now->isBefore($checkin)) {
                        return 'PENDING-IN';
                    }
                    else if($now->isSameDay($checkin)) {
                        return $checkin_states[array_rand(['IN', 'PENDING-IN'])];
                    }
                    else if($now->isAfter($checkout) or $now->isSameDay($checkout)) {
                        return $checkin_states[array_rand(['OUT', 'PENDING-OUT'])];
                    }
                })($checkin, $checkout, $checkin_states),
            ]);
        }

        // Retrieve all reservations
        $reservations = \App\Models\Reservation::all();

        foreach ($reservations as $reservation) {
            $user_id = $reservation->user_id;

            // Seed a rating for each reservation with user_id from reservation
            DB::table('ratings')->insert([
                'rating' => $faker->numberBetween(1, 5), // Customize the rating value
                'comment' => $faker->sentence(),
                'reservation_id' => $reservation->id,
                'user_id' => $user_id,
                'created_at' => $reservation->checkin, // Set created_at to reservation checkin date
                'updated_at' => now(),
            ]);
        }
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
