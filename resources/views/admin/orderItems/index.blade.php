@extends('app')
@section('content')
    <div class="container">
        <h3> <a href="{{route('admin.orders.index')}}" class="btn btn-default btn-sm">Voltar</a></h3>


        <br>

        <h5>See the order items by clicking on the id</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Price</th>
                    <th>Qtd</th>
                </tr>
               
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->qtd}}</td>


                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection