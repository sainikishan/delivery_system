<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\DeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     //
    //     Order::create(['order_name' => 'Order 1']);
    //     Order::create(['order_name' => 'Order 2']);
    // }
    public function run()
    {

        $deliveryBoyA = DeliveryBoy::create(['name' => 'A', 'capacity' => 2, 'max_capacity' => 2]);
        $deliveryBoyB = DeliveryBoy::create(['name' => 'B', 'capacity' => 4, 'max_capacity' => 4]);
        $deliveryBoyC = DeliveryBoy::create(['name' => 'C', 'capacity' => 5, 'max_capacity' => 5]);
        $deliveryBoyD = DeliveryBoy::create(['name' => 'D', 'capacity' => 3, 'max_capacity' => 3]);


        for ($i = 0; $i < 10; $i++) {
            Order::create([
                'order_name' => 'Order ' . ($i + 1),
                'order_number' => 'ORD' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'delivery_boy_id' => null,
                'delivery_duration' => 30,
                'assigned' => false,
                'status' => 'pending',
            ]);
        }
    }
}
