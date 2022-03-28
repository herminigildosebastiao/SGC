@extends('layouts.app')
@section('css') <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> @endsection

@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container">
		<h1 class="my-5">Clientes</h1>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">codigo</th>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
				<th scope="col">Genero</th>
                <th scope="col">Email</th>
				<th scope="col">Data</th>
                <th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($clients as $client)
                    <tr>
                        <th scope="row">{{$client->code}}</th>
                        <td>{{$client->name}}</td>
                        <td>{{$client->last_name}}</td>
                        <td>{{$client->genre}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->created_at}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="#">view</a>
                            <a class="btn btn-danger btn-sm" href="#">delete</a>
                        </td>
                    </tr>
                @empty
                    <h2>Nenhum client disponivel!</h2>
                @endforelse
			</tbody>
		</table>
    </div>
@endsection