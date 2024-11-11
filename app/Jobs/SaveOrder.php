<?php

namespace App\Jobs;

namespace App\Jobs;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderData;

    public function __construct(array $orderData)
    {
  
        $this->orderData = $orderData;
    }

    public function handle()
    {
        // Recreate the order model instance with the passed data
        $order = new Order();
        $order->user_id = $this->orderData['user_id'];
        $order->product_id = $this->orderData['product_id'];
        $order->order_number = $this->orderData['order_number'];
        $order->amount = $this->orderData['amount'];
        $order->quantity = $this->orderData['quantity'];

        // Save the order to the database
        $order->save();
    }
}