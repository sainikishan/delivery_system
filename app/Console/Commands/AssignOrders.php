<?php

namespace App\Console\Commands;

use App\Models\DeliveryBoy;
use App\Models\Order;
use Illuminate\Console\Command;

class AssignOrders extends Command
{
    protected $signature = 'assign:orders';
    protected $description = 'Assign orders to delivery boys based on their capacity';

    public function handle()
    {
        $this->info('Starting order assignment...');

        // Retrieve all delivery boys
        $deliveryBoys = DeliveryBoy::all();

        // Retrieve all unassigned orders
        $orders = Order::where('assigned', false)->get();

        foreach ($orders as $order) {
            foreach ($deliveryBoys as $boy) {

                if ($boy->capacity > 0) {

                    $order->delivery_boy_id = $boy->id;
                    $order->assigned = true;
                    $order->status = 'assigned';
                    $order->delivery_duration = 1;
                    $order->save();
                    $boy->capacity -= 1;
                    $boy->save();
                    $this->info("Assigned Order {$order->order_number} to Delivery Boy {$boy->name}");
                    break;
                }
            }
        }
        $this->info('---');
        $this->info('Checking delivery boys who have remaining capacity or were not assigned fully:');
        $this->info('---');

        foreach ($deliveryBoys as $boy) {
            if ($boy->capacity > 0) {
                $this->info("Delivery Boy {$boy->name} has {$boy->capacity} remaining capacity.");
            }
        }

        $this->info('Order assignment process completed!');
    }
}
