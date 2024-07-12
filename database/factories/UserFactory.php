<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            \App\Models\Alternatif::create([
                'a1' => 'Shopee',
                'a2' => 'Tokopedia',
                'a3' => 'Lazada',
                'a4' => 'Bukalapak',
                'a5' => 'Blibli',
                'user_id' => $user->id,
            ]);

            \App\Models\Bobots::create([
                'c1' => 35,
                'c2' => 15,
                'c3' => 25,
                'c4' => 25,
                'user_id' => $user->id,
            ]);
        });
    }
}
