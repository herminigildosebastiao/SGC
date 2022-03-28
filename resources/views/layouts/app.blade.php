<!DOCTYPE html>
<html lang="PT">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Template For Laravel & ACL</title>
        <meta name="csrf-token" content='{{ csrf_token() }}'>
        <!-- link rel="stylesheet" href="css/bootstrap.min.css" -->
        @yield('css')
        <link rel="stylesheet" href="{{asset('css/dashboard/app.css')}}">
        <!-- link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"-->
    </head>
    <body>

        <!-- inicio da calculadora -->
        <div class="background-calculator" id="background-calculator" style="display: none !important;">
            <div class="calculator" id="calculator">
                <button class="btn-close" id="hide-calculator">x</button>
                <legend>Calculadora</legend>
                <div class="calculator-result">Result: <span id="result"></span></div>
                <div class="calculator-body">
                    <input class="calculator-lcd" id="calc-lcd">
                    <div class="calculator-btn" style="margin-top: 20px;">
                        <button class="btn-number expression" value="7">7</button>
                        <button class="btn-number expression" value="8">8</button>
                        <button class="btn-number expression" value="9">9</button>
                        <button class="btn-number expression" value="/">/</button>
                        <button class="btn-clear" id="btn-clear">Clear</button>
                    </div>
                    <div class="calculator-btn">
                        <button class="btn-number expression" value="4">4</button>
                        <button class="btn-number expression" value="5">5</button>
                        <button class="btn-number expression" value="6">6</button>
                        <button class="btn-number expression" value="*">*</button>
                        <button class="btn-parenteses expression" value="(">(</button>
                        <button class="btn-parenteses expression" value=")">)</button>
                    </div>
                    <div class="calculator-btn">
                        <button class="btn-number expression" value="1">1</button>
                        <button class="btn-number expression" value="2">2</button>
                        <button class="btn-number expression" value="3">3</button>
                        <button class="btn-number expression" value="-">-</button>
                        <button class="btn-parenteses expression" value=",">,</button>
                        <button class="btn-parenteses expression" value="0">0</button>
                    </div>
                    <div class="calculator-btn">
                        <button class="btn-result" id="btn-result">=</button>
                        <button class="btn-plus expression" value="+">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inicio de novo movimento -->
        @yield('form-movement')
        {{--<div class="background-carteira-movel" id="background-carteira-movel" style="display: none !important;">
            <div class="carteira-movel" id="carteira-movel">
                <button class="btn-close" id="hide-carteira-movel">x</button>
                <legend> <span id="movimento-title"></span> </legend>

                @yield('form-movement')
                <button class="btn btn-warning form-preloader" id="form-preloader">carregando</button>
            </div>
        </div>--}}

        <!-- Visualizacao do Saldo de investimento, Carteira, gaveta -->
        {{--<div class="background-saldo" id="background-saldo">
            <div class="saldo" id="saldo">
                <button class="btn-close" id="hide-saldo">x</button>
                <legend></legend>
                <div class="saldo-body">
                    
                    <canvas id="myChart"></canvas>
                    
                </div>
            </div>
        </div>--}}

        <!-- Cabecalho da navbar-->
        <header class="header-fixed">
            <nav class="nav-menu">
                <a href="#" class="nav-menu-logo">SGC</a>
                <nav class="nav-menu-item">
                    <a href="/">
                        <i class="bi bi-house" style="font-size: 28pt;"></i>
                    </a>
                    
                    <a href="#">
                        <i class="bi bi-newspaper"></i>
                    </a>
                    
                    <a href="#">
                        <i class="bi bi-server"></i>
                    </a>
                    
                    <a href="#" id="show-calculator">
                        <i class="bi bi-calculator"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="post" style="display: inline; margin: auto;">
                        @csrf
                        <button type="submit" style="background-color: transparent; color:#fff; border:none; outline:none;">
                            <i class="bi bi-box-arrow-in-left" style="font-size: 33pt;"></i>
                        </button>
                    </form>
                </nav>
            </nav>
            <nav class="nav-search">
                <div class="nav-search-menu">
                    @yield('add')
                    <input type="search" name="" id="" class="input-search" placeholder="Pesguisar...">
                    <button class="btn-search">Encontrar</button>
                </div>
                <a href="#" style="color: #fff; font-size: 25pt;" id="back-page">Voltar</a>
            </nav>
        </header>
        <!-- Cabecalho da navbar-->

        <!-- Content -->
        @yield('content')
        <!-- Content -->

        <!-- Rodape-->
        <br><br>
        <footer>
            <p>Raul Jr, Developer - Todos os direitos reservados</p>
        </footer>
        <!-- Rodape-->
    
        <script src="{{asset('js/dashboard/j1.js')}}"></script>
        <script src="{{asset('js/dashboard/j2.js')}}"></script>
        <!-- script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script-->
        <script src="{{asset('js/dashboard/app.js')}}"></script>
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            /*$(document).ready( function () {
                $('#myTable').DataTable();
            } );*/
        </script>
    </body>
</html>