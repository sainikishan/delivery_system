<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\DeliveryBoy;

class AssignOrdersToDeliveryBoys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-orders-to-delivery-boys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $deliveryBoys = DeliveryBoy::all();
        $orders = Order::where('assigned', false)->get();
        foreach ($orders as $order) {
            foreach ($deliveryBoys as $deliveryBoy) {
                $assignedOrdersCount = $deliveryBoy->orders()->count();
                if ($assignedOrdersCount < $deliveryBoy->max_capacity) {
                    $order->update(['assigned' => true, 'delivery_boy_id' => $deliveryBoy->id]);
                    break;
                }
            }
        }
    }
}
