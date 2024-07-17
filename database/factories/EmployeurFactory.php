<?php

use App\Models\Employeur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeurFactory extends Factory
{
    protected $model = Employeur::class;


    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'user_id' => User::factory(),

        ];
    }
}
