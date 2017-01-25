@extends('app')
@section('content')
    <div class="container">
        <h3>Oders</h3>


        <br>

        <h5>See the order items by clicking on the id</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>User Delivery</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
               
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><a href="{{route('admin.ordersItens.index',['id' => $order->id])}}" >{{$order->id}}</a></td>
                        <td>{{$order->client->user->name}}</td>
                        <td>{{$order->deliveryman->name}}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->status->name}}</td>
                        <td>
                            <a href="{{route('admin.orders.edit',['id' => $order->id])}}" class="btn btn-default btn-sm">Editar</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
@endsection