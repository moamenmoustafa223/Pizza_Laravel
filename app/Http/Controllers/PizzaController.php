<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaSotreRequest;
use App\Http\Requests\PizzaUpdateRequest;
use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pizzas.index', ['pizzas' => Pizza::paginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pizzas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PizzaSotreRequest $request)
    {
        $path = $request->image->store('public/pizza');
        Pizza::create([
            'name' => $request->name,
            'description' => $request->description,
            'small_pizza_price'=> $request->small_pizza_price,
            'medium_pizza_price'=> $request->medium_pizza_price,
            'large_pizza_price'=> $request->large_pizza_price,
            'category' => $request->category,
            'image' => $path,
        ]);
        return redirect()->route('pizzas.index')->with('message','Pizza added successfully!');
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
      
        return view('pizzas.edit', ['pizza' => Pizza::find($id)]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PizzaUpdateRequest $request, string $id)
{
    $pizza = Pizza::find($id);

    if (!$pizza) {
        return redirect()->route('pizzas.index')->with('error', 'Pizza not found.');
    }

    $pizza->name = $request->name;
    $pizza->description = $request->description;
    $pizza->small_pizza_price = $request->small_pizza_price;
    $pizza->medium_pizza_price = $request->medium_pizza_price;
    $pizza->large_pizza_price = $request->large_pizza_price;
    $pizza->category = $request->category;

    if ($request->hasFile('image')) {
        $pizza->image = $request->image->store('public/pizza');
    }

    $pizza->save();

    return redirect()->route('pizzas.index')->with('message', 'Pizza updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();
        return redirect()->route('pizzas.index')->with('message', 'Pizza deleted successfully!');
        //
    }
}
