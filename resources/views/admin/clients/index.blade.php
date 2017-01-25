@extends('app')
@section('content')
    <div class="container">
        <h3>Clients</h3>

        <a href="{{route('admin.clients.create')}}" class="btn btn-default"> Novo Cliente</a>
        <br>
        <br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->user->name}}</td>
                        <td>{{$client->fone}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->city}}</td>
                        <td>{{$client->state}}</td>
                        <td>{{$client->zipcode}}</td>
                        <td>
                            <a href="{{route('admin.clients.edit',['id' => $client->id])}}" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('admin.clients.destroy',['id' => $client->id])}}" class="btn btn-danger btn-sm">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>
@endsection
