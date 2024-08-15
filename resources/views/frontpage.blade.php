@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    <form action="{{route('frontpage')}}" class="list-group" method="get">
                        <a class="list-group-item" href="/">Back</a>
                        <input type="submit" value="Vegetarian" name="category" class="list-group-item ">
                        <input type="submit" value="Nonvegetarian" name="category" class="list-group-item ">
                        <input type="submit" value="Traditional" name="category" class="list-group-item ">
                        <input type="submit" value="Peri peri chicken" name="category" class="list-group-item ">
                        <input type="submit" value="Garlic PRAWN" name="category" class="list-group-item ">
                        <input type="submit" value="Chicken & Camembert" name="category" class="list-group-item ">
                        <input type="submit" value="Loaded pepperoni" name="category" class="list-group-item ">
                        <input type="submit" value="Spicy peppy paneer" name="category" class="list-group-item ">
                        <input type="submit" value="Spicy pepperoni" name="category" class="list-group-item ">
                        <input type="submit" value="Vegi pepperoni" name="category" class="list-group-item ">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pizza</div>
               
                <div class="card-body">
                    <div class="row">
                        @forelse ($pizzas as $pizza)
                            <div class="col-md-4 mt-2 text-center" style="border: 1px solid #ccc;">
                                <img src="{{ Storage::url($pizza->image) }}" class="img-thumbnail" style="width: 100%;">
                                <p>{{ $pizza->name }}</p>
                                <p>{{ $pizza->description }}</p>
                                <p>{{ $pizza->category }}</p>
                                <a href="{{ route('pizzas.show', $pizza->id) }}">
                                    <button class="btn btn-danger mb-1">Order Now</button>
                                </a>
                            </div>
                        @empty
                            <p>No pizzas to show</p>
                        @endforelse
                    </div>
                    {{ $pizzas->links() }}
                </div>
                
            </div>
        </div>
    </div>
</div>
<style>
    a.list-group-item {
        font-size: 18px;
    }

    .list-group-item:hover {
        background-color: red;
        color: #fff;
    }

    .card-header {
        background-color: red;
        color: #fff;
        font-size: 20px;
    }

</style>
@endsection
