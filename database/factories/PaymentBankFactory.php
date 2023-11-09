<?php

namespace Database\Factories;

use App\Models\PaymentBank;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentBank>
 */
class PaymentBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PaymentBank::class;

    public function definition(): array
    {
        return [
            'account_name' => 'BlueDoorz Ltd',
            'bank_account' => $this->faker->creditCardNumber,
        ];
    }
}
