<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = Order::with(['customer' => function($query) {
                $query->where('id', 'id_customer');
            }])->whereHas('customer', function($query) {
                $query->where('id', 'id_customer');
            })->get();

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Order::create([
                'code' => $request->code,
                'customer_id' => $request->customer_id,
                'product_name' => $request->product_name,
                'brand_name' => $request->brand_name,
                'qty' => $request->qty,
                'price' => $request->price,
                'total_price' => $request->qty * $request->price,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $orders = Order::with(['customer' => function($query) {
                $query->where('id', 'id_customer');
            }])->whereHas('customer', function($query) {
                $query->where('id', 'id_customer');
            })->where('id', $id)->first();

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
            $order->update([
                'code' => $request->code,
                'customer_id' => $request->customer_id,
                'product_name' => $request->product_name,
                'brand_name' => $request->brand_name,
                'qty' => $request->qty,
                'price' => $request->price,
                'total_price' => $request->qty * $request->price,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
