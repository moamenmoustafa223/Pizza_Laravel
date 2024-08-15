@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
             
                @if (count($errors) > 0)
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                               <p> {{ $error }}<p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pizza</div>
                    <form action="{{ route('pizzas.update', $pizza->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                       

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name of pizzza</label>
                                    <input type="text" value="{{ $pizza->name }}" class="form-control" name="name" placeholder="name of pizza">
                            </div>
                            <div class="form-group">
                                <label for="description">Description of pizzza</label>
                                <textarea class="form-control" name="description">{{ $pizza->description }}
                                </textarea>
                            </div>
                            <div class="form-inline">
                                <label>Pizza price($)</label>
                                <input type="number" value="{{ $pizza->small_pizza_price }}" name="small_pizza_price" class="form-control"
                                    placeholder="small pizza price">
                                <input type="number" value="{{ $pizza->medium_pizza_price }}" name="medium_pizza_price" class="form-control"
                                    placeholder="medium pizza price">
                                <input type="number" value="{{ $pizza->large_pizza_price }}" name="large_pizza_price" class="form-control"
                                    placeholder="large pizza price">

                            </div>
                            <div class="form-group">
                                <label for="description">Category</label>
                                <select class="form-control" name="category">
                                    <option value="" disabled >select category</option>
                                    <option value="vegetarian" {{ $pizza->category == 'vegetarian' ? 'selected' : '' }}>Vegetarian Pizza</option>
                                    <option value="nonvegetarian" {{ $pizza->category == 'nonvegetarian' ? 'selected' : '' }}>Non vegetarian Pizza</option>
                                    <option value="traditional" {{ $pizza->category == 'traditional' ? 'selected' : '' }}>Traditional Pizza</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image"  class="form-control" name="image">
                                <img src="{{ Storage::url($pizza->image) }}" width="100px" alt="">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">update</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
