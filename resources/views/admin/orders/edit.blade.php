@extends('app')
@section('content')
    <div class="container">
        <h3>Pedido #{{$order->id}} - R$ {{$order->total}}</h3>
        <h3>Cliente {{$order->client->user->name}}</h3>
        <h3>Data {{$order->created_at}}</h3>
        <p>
            <b>Entregar em:</b>
            {{$order->client->address}} - {{$order->client->city}} - {{$order->client->state}}
        </p>
        @include('errors._check')

        {!! Form::model($order,['route' =>['admin.orders.update',$order->id]]) !!}

        @include('admin.orders._form')

        <div class="form-group">
            {!! Form::submit('Salvar',['class' =>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection