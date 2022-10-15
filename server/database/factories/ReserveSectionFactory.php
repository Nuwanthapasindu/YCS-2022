<?php

namespace Database\Factories;

use App\Models\section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\section>
 */
class ReserveSectionFactory extends Factory
{
    protected $model = section::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid'=>Uuid::generate()->string,
            'section'=>'Reserve',
            'additional_data'=> "RESERVE SECTION"
        ];
    }
}
