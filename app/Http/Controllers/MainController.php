<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Coin;
use App\Models\Investment;
use App\Models\Material;
use App\Models\MovementCredelec;
use App\Models\MovementFipag;
use App\Models\MovementInformatic;
use App\Models\MovementMobileRecharge;
use App\Models\MovementMobileWallet;
use App\Models\MovementTv;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('dashboard.main');
    }

    public function getData(){
        $funcionarios = User::getUsers();
        $clientes = Client::getClients();
        $investimento = Investment::getAmountToday();
        $moedas = Coin::getCoinsToday();
        $carteiras_moveis = MovementMobileWallet::getAmountToday();
        $servicos_informaticos = MovementInformatic::getAmountToday();
        $recargas_moveis = MovementMobileRecharge::getAmountToday();
        $recargas_tv = MovementTv::getAmountToday();
        $fipag = MovementFipag::getAmountToday();
        $credelec = MovementCredelec::getAmountToday();
        $servicos = Service::getServicesToday();
        $materias = Material::getMaterialsToday();
        
        $data = ['funcionarios' => $funcionarios, 'clientes' => $clientes, 'investimento' => $investimento, 'moedas' => $moedas, 'carteiras_moveis' => $carteiras_moveis, 'servicos_informaticos' => $servicos_informaticos, 'recargas_moveis' => $recargas_moveis, 'recargas_tv' => $recargas_tv, 'fipag' => $fipag, 'credelec' => $credelec, 'servicos' => $servicos, 'materias' => $materias, 'divid' => 0.00];

        return response()->json($data);
    }

    public function getService($code){
        $services = ServiceCategory::with('getServices')->find($code);
        return response()->json($services->getServices);
    }

    //funcao para retornar os precos
    public function getPrices($code){
        $prices = Service::with('getPrices')->find($code);
        return response()->json($prices->getPrices);
    }
}
