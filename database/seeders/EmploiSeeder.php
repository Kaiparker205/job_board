<?php

namespace Database\Seeders;

use App\Models\Emploi;
use Illuminate\Database\Seeder;

class EmploiSeeder extends Seeder
{
    public function run()
    {
        Emploi::factory(50)->create();
    }
}
