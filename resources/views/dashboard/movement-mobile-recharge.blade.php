@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
@endsection

@section('add')
    <button class="btn-new btn-show-mobile-recharge" id="show-mobile-recharge">
        <i class="bi bi-clipboard-plus"></i>
    </button>
@endsection

@section('form-movement')
    <!-- Inicio de novo movimento -->
    <div class="background-carteira-movel" id="background-carteira-movel" style="display: none !important;">
        <div class="carteira-movel" id="carteira-movel">
            <button class="btn-close btn-show-servicos-informaticos" id="xhide-carteira-movel">x</button>
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

@section('add')
    <button class="btn-new" id="show-recargas">
        <i class="bi bi-clipboard-plus"></i>
    </button>
@endsection

@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container">
		<h1 class="my-5">Recargas Moveis</h1>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">#</th>
                <th scope="col">Provedora</th>
				<th scope="col">Montante MT</th>
				<th scope="col">Servico</th>
                <th scope="col">Data</th>
				<th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($movements as $movement)
                    <tr>
                        <th scope="row">{{$movement->id}}</th>
                        <td>{{$movement->getProvider->name}}</td>
                        <td>{{$movement->amount}}</td>
                        <td>{{$movement->getService->name}}</td>
                        <td>{{$movement->created_at}}</td>
                        <td>
                            {{-- <a class="btn btn-primary btn-sm" href="#">view</a>  --}}
                            @if ($movement->status)
                                <form class="movement-mobile-recharge-update-status" style="display: inline;">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="0">
                                    <input type="hidden" name="id" value="{{$movement->id}}">
                                    <button type="submit" class="btn btn-warning btn-sm" href="#">spnd</button>
                                </form>
                            @else
                                <form style="display: inline;" class="movement-mobile-recharge-update-status">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="1">
                                    <input type="hidden" name="id" value="{{$movement->id}}">
                                    <button type="submit" class="btn btn-success btn-sm" href="#">activ</button>
                                </form>
                            @endif
    
                            <form style="display: inline;" class="form-movement-mobile-recharge-delete" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name='id' class='id' value="{{$movement->id}}">
                                <button class="btn btn-danger btn-sm " >dlet</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <h2>Nenhum movimento disponivel!</h2>
                @endforelse
			</tbody>
		</table>
    </div>
@endsection