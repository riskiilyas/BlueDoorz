<?php

namespace Database\Factories;

use App\Models\BranchAddress;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->numerify('Room ###'),
            'image_path' => fake()->imageUrl(),
            'type_id' => fake()->randomElement(RoomType::all())['id'],
            'branch_address_id' => $this->faker->randomElement(BranchAddress::all())['id']
        ];
    }
}
