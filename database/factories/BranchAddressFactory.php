<?php

namespace Database\Factories;

use App\Http\Services\LocationService;
use App\Models\BranchAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BranchAddressFactory extends Factory
{
    protected $model = BranchAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locationService = new LocationService();
        $data = $locationService->generateRandom();

        return [
            'city' => $data['city'],
            'state' => $data['state'],
            'postal_code' => $this->faker->postcode(),
            'street_address' => $this->faker->unique()->streetAddress(),
            'contact_branch' => $this->faker->phoneNumber()
        ];
    }
}
