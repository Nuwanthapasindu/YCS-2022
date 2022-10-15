<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\student>
 */
class StudentFactory extends Factory
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
            'admission_number'=>rand(5000,99000),
            'full_name'=>$this->faker->name('male'),
            'mobile_number'=>rand(1111111111,9999999999),
            'address'=>$this->faker->address,
            'mother_name'=>$this->faker->name('female'),
            'father_name'=>$this->faker->name('male'),
        ];
    }
}
