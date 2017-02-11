@extends('app')
@section('content')
    <div class="container">
        <h3>Novo Pedido</h3>

        @include('errors._check')

        <div class="container">
            {!! Form::open(['class' => 'form' ]) !!}}

            <div class="form-group">
                <label>Total:</label>

                <p id="total"></p>
                <a href="#" class="btn btn-default">Novo Item</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Produto</th>
                                <th> Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

          </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection