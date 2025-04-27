<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryBoy;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DeliveryBoy::create(['name' => 'A', 'max_capacity' => 2]);
        DeliveryBoy::create(['name' => 'B', 'max_capacity' => 4]);
        DeliveryBoy::create(['name' => 'C', 'max_capacity' => 5]);
        DeliveryBoy::create(['name' => 'D', 'max_capacity' => 3]);
    }
}
