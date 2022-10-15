<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\section>
 */
class sectionFactory extends Factory
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
            'section'=>'*',
            'additional_data'=> "ADMIN CLASS"
        ];
//        'uuid'=>Uuid::generate()->string,
//                 'section'=>'Reserve',
//                 'additional_data'=> "RESERVE SECTION"
    }
}
