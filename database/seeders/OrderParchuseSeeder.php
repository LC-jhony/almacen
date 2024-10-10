<?php

namespace Database\Seeders;

use App\Models\OrderParchuse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderParchuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderParchuse::factory()->count(10)->create();
    }
}
