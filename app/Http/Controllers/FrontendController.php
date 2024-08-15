<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaOrderRequest;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        // Validate the category parameter
        $validatedData = $request->validate([
            'category' => 'nullable|string|max:255',
        ]);
    
        // Build the query
        $query = Pizza::query();
    
        // Filter by category if present
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }
    
        // Optionally add pagination
        $pizzas = $query->latest()->paginate(1);
    
        // Maintain the category filter in the pagination links
        $pizzas->appends($request->all());
    
        // Return the view with pizzas data
        return view('frontpage', ['pizzas' => $pizzas]);
    }
            public function show(string $id)
        {
            return view('pizzas.show', ['pizza' => Pizza::findOrFail($id)]);
            //
        }
        public function store(PizzaOrderRequest $request)
        {
            // if ($request->small_pizza <= 0 && $request->medium_pizza <= 0 && $request->large_pizza <= 0) {
            //     return back()->with('errmessage', 'Please order at least one pizza. Quantities must be greater than zero.');
            // }
            // if ($request->small_pizza < 0 || $request->medium_pizza < 0 || $request->large_pizza < 0) {
            //     return back()->with('errmessage', 'Pizza quantities cannot be negative. Please enter a valid number.');
            // }
            // $maxOrderLimit = 100; // Example limit

            // if ($request->small_pizza > $maxOrderLimit || $request->medium_pizza > $maxOrderLimit || $request->large_pizza > $maxOrderLimit) {
            //     return back()->with('errmessage', 'You cannot order more than ' . $maxOrderLimit . ' pizzas of each size.');
            // }
            Order::create([
                'time' => $request->time,
                'date' => $request->date,
                'user_id' => auth()->user()->id,
                'pizza_id' => $request->pizza_id,
                'small_pizza' => $request->small_pizza,
                'medium_pizza' => $request->medium_pizza,
                'large_pizza' => $request->large_pizza,
                'body' => $request->body,
                'phone' => $request->phone
            ]);
            return back()->with('message', 'Your order was successfull');
    
        }
    //
}
