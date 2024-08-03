<?php

namespace Database\Seeders;

use App\Models\Training;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrainingSeeder extends Seeder
{
    public function run()
    {
        $trainings = Training::factory()
            ->count(5)
            ->create();
    }
}
