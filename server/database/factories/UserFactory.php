<?php

namespace Database\Factories;

use App\enum\roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

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
    public function definition()
    {
        return [
            'uuid'=>Uuid::generate()->string,
            'profile_pic'=>'https://images.unsplash.com/photo-1618641986557-1ecd230959aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
            'full_name'=>$this->faker->name,
            'mobile_number'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'email'=>'hnpkdias@gmail.com',
            'password'=>Hash::make('12345678'),
            'role'=>'admin',
            'status'=> true,
            'completed'=> true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
