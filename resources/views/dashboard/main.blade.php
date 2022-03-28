@extends('layouts.app')

@section('add')
    <button class="btn-new">
        <i class="bi bi-clipboard-plus"></i>
    </button>
@endsection
@section('content')

    <div class="container">

        <div class="painel-control">
            <div class="card">
                <a href="{{ route('user.index') }}">
                    <h3>Funcionarios</h3>
                    <div class="icon-qnt">
                        <i class="bi bi-people"></i>
                        <h2 id="func"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-hover"></div>
                <a href="{{ route('client.index') }}">
                    <h3>Clientes</h3>
                    <div class="icon-qnt">
                        <i class="bi bi-people-fill"></i>
                        <h2 id="client"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('investment.index') }}">
                    <h3>Investimento</h3>
                    <div class="icon-qnt">
                        <i class="bi bi-server"></i>
                        <h3 id="invest"></h3>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('coin.index') }}">
                    <h3>Moedas</h3>
                    <div class="icon-qnt">
                        <i class="bi bi-currency-exchange"></i>
                        <h2 id="coin"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('movement-mobile-wallet.index') }}">
                    <h3>Carteiras Moveis</h3>
                    <div class="icon-qnt">
                        <img src="{{asset('image/mp.jpg')}}" alt="" style="border-radius: 5px 15px 5px 15px;">
                        <h2 id="mobile_wallet"></h2>
                    </div>
                    <h4>de: <span id="in"></span> le: <span id="out"></span></h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('movement-informatic.index') }}">
                    <h3>Servicos Informaticos</h3>
                    <div class="icon-qnt">
                        <i class="bi bi-printer"></i>
                        <h2 id="sinformatic"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('movement-mobile-recharge.index') }}">
                    <h3>Recargas Moveis</h3>
                    <div class="icon-qnt">
                        <img src="{{asset('image/movitel.png')}}" alt="">
                        <h2 id="rmoveis"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('movement-tv.index') }}">
                    <h3>Recargas TV</h3>
                    <div class="icon-qnt">
                        <img src="{{asset('image/zap.png')}}" alt="">
                        <h2 id="rtv"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            <div class="card">
                <a href="{{ route('movement-fipag.index') }}">
                    <h3>Fipag</h3>
                    <div class="icon-qnt">
                        <img src="{{asset('image/fipag.jpg')}}" alt="">
                        <h2 id="fipags"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>

            <div class="card">
                <a href="{{ route('movement-credelec.index') }}">
                    <h3>Credelec</h3>
                    <div class="icon-qnt">
                        <img src="{{asset('image/edm.jpg')}}" alt="">
                        <h2 id="credelecs"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>

            <div class="card">
                <a href="{{ route('service.index') }}">
                    {{--<h3>Serviços</h3>--}}
                    <div class="icon-qnt">
                        <i class="bi bi-gear"></i>
                        <h2 id="service"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>

            <div class="card">
                <a href="{{ route('material.index') }}">
                    {{-- <h3>Materias</h3> --}}
                    <div class="icon-qnt">
                        <i class="bi bi-basket"></i>
                        <h2 id="material"></h2>
                    </div>
                    <h4>Data: {{ date('d-m-Y') }}</h4>
                </a>
            </div>
            
        </div>
        
    </div>
    
@endsection