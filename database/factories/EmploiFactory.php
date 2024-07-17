<?php

namespace Database\Factories;

use App\Models\Emploi;
use App\Models\Employeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploiFactory extends Factory
{
    protected $model = Emploi::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->sentence(),
            'salary' => $this->faker->randomFloat(2, 3000, 10000),
            'employeur_id' => 2,
            'delay' => $this->faker->numberBetween(1, 10),
        ];
    }
}
