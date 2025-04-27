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
                // Check if the delivery boy has remaining capacity
                if ($boy->capacity > 0) {
                    // Assign the order to the delivery boy
                    $order->delivery_boy_id = $boy->id;
                    $order->assigned = true;
                    $order->status = 'assigned';

                    // Optionally, you can update the delivery_duration based on your logic
                    // Example: Adjust the delivery duration based on the order or delivery boy (for simplicity, we're keeping it as 30 minutes here)
                    $order->delivery_duration = 30; // Or set any other logic here for duration
                    $order->save();

                    // Decrease the capacity of the delivery boy
                    $boy->capacity -= 1;
                    $boy->save();

                    // Output a message to the console for confirmation
                    $this->info("Assigned Order {$order->order_number} to Delivery Boy {$boy->name}");

                    // Exit the inner loop after assigning an order to a delivery boy
                    break;
                }
            }
        }

        // Display remaining delivery boys who still have capacity
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
