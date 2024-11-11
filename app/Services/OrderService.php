<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Jobs\SaveOrder;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderService
{
    /**
     * Handle order creation and dispatch the job.
     *
     * @param int $productId
     * @param float $amount
     * @param int $quantity
     * @return array
     */
    public function createOrder(int $productId, float $amount, int $quantity): array
    {
        $user = Auth::user();

        // Prepare data to pass to the job
        $orderData = [
            'user_id' => $user->id,
            'product_id' => $productId,
            'order_number' => Str::uuid()->toString(),
            'amount' => $amount,
            'quantity' => $quantity
        ];

        // Dispatch the job to save the order
        SaveOrder::dispatch($orderData);

        // Send notification to the user
        $user->notify(new OrderCreated($orderData));

        return $orderData;
    }

    public function getOrders(Request $request)
    {
        $query = Order::with(['user', 'product']);

        // Filter by fullname if the parameter is provided
        if ($request->has('fullname') && $request->input('fullname') !== '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->input('fullname') . '%');
            });
        }

        // Filter by product name if the parameter is provided
        if ($request->has('product') && $request->input('product') !== '') {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('product') . '%');
            });
        }

        // Filter by amount if the parameter is provided
        if ($request->has('amount') && $request->input('amount') !== '') {
            $query->where('amount', $request->input('amount'));
        }

        // Filter by order number if the parameter is provided
        if ($request->has('order_number') && $request->input('order_number') !== '') {
            $query->where('order_number', $request->input('order_number'));
        }
        return $query->get();
    }
}