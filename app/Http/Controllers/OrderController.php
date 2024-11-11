<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index(Request $request)
    {
        // Use the OrderService to handle order retrieval
        $orders = $this->orderService->getOrders($request);

        // Return the orders as JSON response
        return response()->json($orders);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $productId = $request->query('product_id');
        $amount = $request->query('amount');
        $quantity = $request->query('quantity');

        // Use the OrderService to handle order creation
        $orderData = $this->orderService->createOrder($productId, $amount, $quantity);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Product added to queue',
            'data' => [
                'user_id' => $orderData['user_id'],
                'product_id' => $orderData['product_id'],
                'amount' => $orderData['amount'],
                'quantity' => $orderData['quantity'],
            ],
        ]);
    }




    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}