@extends('app')
@section('content')
    <div class="container">
        <h3>Editando Pedido {{$order->id}}</h3>

        @include('errors._check')

        {!! Form::model($order,['route' =>['admin.orders.update',$order->id]]) !!}

        @include('admin.orders._form')

        <div class="form-group">
            {!! Form::submit('Salvar',['class' =>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection