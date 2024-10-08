<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['pizza', 'user']) // Adjust as needed for your model's relationships
        ->orderBy('id', 'desc')
        ->paginate(1); // Use pagination for better performance with large datasets

            return view('orders.index', ['orders' => $orders]);        //
    }
    public function customers()
    {
        $customers = User::where('is_admin', 0)->paginate(1); 
    

        return view('customers', ['customers' => $customers]);
    }
    

        public function changeStatus(Request $request, string $id){
            $order = Order::find($id);
            $order->status = $request->status;
            $order->save();
            return redirect()->route('orders.index')->with('message', 'Order status updated successfully!');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
