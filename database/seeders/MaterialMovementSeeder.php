<?php

namespace Database\Seeders;

use App\Models\MaterialMovement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialMovement::factory()->count(10000)->create();
    }
}
