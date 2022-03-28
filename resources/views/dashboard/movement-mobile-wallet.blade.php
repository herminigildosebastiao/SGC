@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
@endsection

@section('add')
    <button class="btn-new btn-show-carteira-movel">
        <i class="bi bi-clipboard-plus"></i>
    </button>
@endsection

@section('form-movement')
    <!-- Inicio de novo movimento -->
    <div class="background-carteira-movel" id="background-carteira-movel" style="display: none !important;">
        <div class="carteira-movel" id="carteira-movel">
            <button class="btn-close btn-show-carteira-movel">x</button>
            <legend> <span id="movimento-title"></span> </legend>
            <form method="post" id="form-carteira-movel" action="{{ route('movement-mobile-wallet.store') }}">
                @csrf
                <div class="form-group">
                    <div class="mobile-service">
                        <input type="radio" name="service_id" id="mpesa" value="66" form="form-carteira-movel" required>
                        <label for="mpesa">Mpesa</label>
        
                        <input type="radio" name="service_id" id="ponto24" value="67" form="form-carteira-movel" required>
                        <label for="ponto24">ponto 24</label>
                    </div>
                    <br><br>
                </div>
                <div class="form-super-group">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input class="form form-max input-form-carteira-movel" name="name" type="text" id="name" form="form-carteira-movel" minlength="3" required>
                    </div>
        
                    <div class="form-group">
                        <label for="phone">Contacto</label>
                        <input id="phone" class="form form-min input-form-carteira-movel" name="contact" type="text" form="form-carteira-movel" minlength="9" maxlength="9" required>
                    </div>
                </div>
        
                <div class="form-super-group">
                    <div class="form-group">
                        <label for="montante">Montante</label>
                        <input id="montante" class="form form-min input-form-carteira-movel" name="amount" type="number" form="form-carteira-movel" required>
                    </div>
        
                    <div class="form-group">
                        <label for="operation">Tipo de operacao</label>
                        <select name="operation_type_id" id="operation" class="form form-max input-form-carteira-movel" form="form-carteira-movel" required>
                            <option value="">escolha..</option>
                            <option value="1">Deposito</option>
                            <option value="2">Levantamento</option>
                        </select>
                    </div>
                </div>
        
                <button type="submit" class="btn-cadastrar" form="form-carteira-movel" >Cadastrar</button>
        
            </form>
            <button class="btn btn-warning form-preloader" id="form-preloader">carregando</button>
        </div>
    </div>
@endsection


@section('content')
    <!-- sessao de historico de servicos -->
    <div class="container-content">
		<h1 class="my-2 h2 text-secondary" >Carteiras moveis</h1>
		<table class="table table-striped table-sm table-responsive" id="myTable">
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Nome</th>
				<th scope="col">Contacto</th>
                <th scope="col">Operacao</th>
				<th scope="col">Montante MT</th>
				<th scope="col">Servico</th>
                <th scope="col">Data</th>
				<th scope="col">Acao</th>
				</tr>
			</thead>
			<tbody id="table-body">
				@forelse ($movements as $movement)
                    <tr>
                        <th scope="row">{{$movement->id}}</th>
                        <td>{{$movement->name}}</td>
                        <td>{{$movement->contact}}</td>
                        <td>{{$movement->getOperation->name}}</td>
                        <td>{{$movement->amount}}</td>
                        <td>{{$movement->getService->name}}</td>
                        <td>{{$movement->created_at}}</td>
                        <td>
                            {{-- <a class="btn btn-primary btn-sm" href="#">view</a> --}}
                            @if ($movement->status)
                                <form method="post" action="{{ route('movement-mobile-wallet-update-status') }}" class="movement-mobile-wallet-update-status" style="display: inline;">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="0">
                                    <input type="hidden" name="id" value="{{$movement->id}}">
                                    <button type="submit" class="btn btn-warning btn-sm" href="#">spnd</button>
                                </form>
                            @else
                                <form action="{{ route('movement-mobile-wallet-update-status') }}" {{-- id="form-movement-mobile-wallet" --}} style="display: inline;" class="movement-mobile-wallet-update-status">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="1">
                                    <input type="hidden" name="id" value="{{$movement->id}}">
                                    <button type="submit" class="btn btn-success btn-sm" href="#">activ</button>
                                </form>
                            @endif
    
                            <form style="display: inline;" class="form-movement-mobile-wallet-delete" method="POST">
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