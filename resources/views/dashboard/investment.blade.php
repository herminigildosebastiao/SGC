@extends('layouts.app')
@section('css') <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> @endsection

@section('form-movement')
    <!-- Inicio de novo movimento -->
    <div class="background-carteira-movel" id="background-carteira-movel" styles="display: none !important;">
            <div class="carteira-movel" id="carteira-movel">
                <button class="btn-close" id="hide-carteira-movel">x</button>
                <legend> <span id="movimento-title"></span> </legend>
                <form id="form-mobile-recharge">
                    @csrf
                    <div class="form-super-group">
                        <!-- para recargas moveis -->
    
                        <div class="form-group form-movel">
                            <label for="montante">Montante</label>
                            <input id="montante" class="form form-min" type="number" min="10" name="amount" required>
                        </div>
    
                        <div class="form-group form-movel">
                            <label for="operation">Operadora</label>
                            <select name="mobile_provider" id="operation" class="form form-max" required>
                                <option value="">escolha..</option>
                                <option value="1">Movitel</option>
                                <option value="4">T-mcel</option>
                                <option value="3">Vodacom</option>
                            </select>
                        </div>
                        <input type="hidden" name="service_id" value="65">
                    </div>
                    <button type="submit" class="btn-cadastrar">Cadastrar</button>
                </form>
            </div>
        </div>
@endsection

@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container">
		<h1 class="my-5">Investimentos</h1>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descricao</th>
                <th scope="col">Montante MT</th>
				<th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($investments as $investment)
                    <tr>
                        <th scope="row">{{$investment->id}}</th>
                        <td>{{$investment->name}}</td>
                        <td>{{$investment->label}}</td>
                        <td>{{$investment->amount}}</td>
                        <td>
                            <button class="btn btn-primary btn-sm show-form-investment">edit</button>
                        </td>
                    </tr>
                @empty
                    <h2>Nenhum dado disponivel</h2>
                @endforelse
			</tbody>
		</table>
    </div>
@endsection