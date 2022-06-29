<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sectionClasses>
 */
class sectionClassesFactory extends Factory
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
            'section_id'=>1,
            'class_name'=>'*',
            'other'=>"ADMIN CLASS",
            'year'=>date('Y')
        ];
    }
}
