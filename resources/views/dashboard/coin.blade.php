@extends('layouts.app')
@section('css') <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> @endsection

@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container">
		<h1 class="my-5">Moedas</h1>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">#</th>
                <th scope="col">Valor MT</th>
                <th scope="col">Descricao</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Data</th>
				<th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($coins as $coin)
                    <tr>
                        <th scope="row">{{$coin->id}}</th>
                        <td>{{$coin->value}}</td>
                        <td>{{$coin->label}}</td>
                        <td>{{$coin->quantity}}</td>
                        <td>{{$coin->created_at}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="#">view</a> 
                            <a class="btn btn-danger btn-sm" href="#">delete</a>
                        </td>
                    </tr>
                @empty
                    <h2>Nenhuma moeda disponivel</h2>
                @endforelse
			</tbody>
		</table>
    </div>
@endsection