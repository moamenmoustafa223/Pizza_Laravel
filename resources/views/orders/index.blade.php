@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
              </nav>
            <div class="card">
                <div class="card-header">orders
                    <a style="float:right;" href="{{route('pizzas.index')}}"><button class="btn btn-secondary btn-sm" style="margin-left: 5px;">View Pizza</button></a>
                    <a style="float:right;" href="{{route('pizzas.create')}}"><button class="btn btn-secondary btn-sm">Add new Pizza</button></a>
                </div>

              
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Phone/Email</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">S. pizza</th>
                                <th scope="col">M. pizza</th>
                                <th scope="col">L. pizza</th>
                                <th scope="col">Total($)</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Accept</th>
                                <th scope="col">Reject</th>
                                <th scope="col">Order<br>Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders && count($orders) > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                <td >{{ $order->user->email }}<br>{{$order->phone}}</td>
                                    <td>{{ $order->date }}/{{ $order->time }}</td>
                                    <td>{{ $order->pizza->name }}</td>

                                    <td>{{ $order->small_pizza }}</td>
                                    <td>{{ $order->medium_pizza }}</td>
                                    <td>{{ $order->large_pizza }}</td>
                                    <td>${{ ($order->pizza->small_pizza_price * $order->small_pizza)+
                                        ($order->pizza->medium_pizza_price * $order->medium_pizza)+
                                        ($order->pizza->large_pizza_price * $order->large_pizza)
                                        }}</td>
                                    <td>{{ $order->body }}</td>
                                    <td>{{ $order->status }}</td>
                                    <form action="{{ route('order.status',$order->id) }}" method="post">@csrf
                                        <td>
                                            <input name="status" type="submit" value="accepted"
                                                class="btn btn-primary btn-sm">
                                        </td>
                                        <td>
                                            <input name="status" type="submit" value="rejected"
                                                class="btn btn-danger btn-sm">
                                        </td>
                                        <td>
                                            <input name="status" type="submit" value="completed"
                                                class="btn btn-success btn-sm">
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            @else
                            <p>No orders</p>
                            @endif
                        </tbody>
                    </table>
                    {{ $orders->links() }}


                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .alert {
        transition: opacity 0.5s ease-in-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500); // Matches the transition duration in the CSS
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    });
</script>
@endsection
