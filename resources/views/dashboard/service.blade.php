@extends('layouts.app')
@section('css') <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> @endsection

@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container">
		<h1 class="my-5">Serviços</h1>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descricao</th>
                <th scope="col">Categoria</th>
				<th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($services as $service)
                    <tr>
                        <th scope="row">{{$service->id}}</th>
                        <td>{{$service->name}}</td>
                        <td>{{$service->label}}</td>
                        <td>{{$service->getCategory->name}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="#">view</a>
                            <a class="btn btn-warning btn-sm" href="#">suspend</a>
                            <a class="btn btn-danger btn-sm" href="#">delete</a>
                        </td>
                    </tr>
                @empty
                    <h2>Nenhum movimento disponivel!</h2>
                @endforelse
			</tbody>
		</table>
    </div>
@endsection