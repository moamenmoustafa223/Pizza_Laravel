<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('orders.index');
        }
        $orders = Order::with(['pizza'])
            ->latest()
            ->where('user_id', auth()->user()->id) // You can use auth()->id() for shorter syntax
            ->paginate(1); // Consider pagination if orders can be numerous

        return view('home', ['orders' => $orders]);
    }
}
