<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\MovementMobileWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementMobileWalletController extends Controller
{
    
    public function index()
    {
        $movements = MovementMobileWallet::with(['getOperation', 'getService'])->get();
        return view('dashboard.movement-mobile-wallet', compact('movements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MovementMobileWallet $movementMobileWallet)
    {
        try {
            $status = $movementMobileWallet->create([
                'name' => $request->name,
                'contact' => $request->contact,
                'amount' => $request->amount,
                'operation_type_id' => $request->operation_type_id,
                'status' => '1',
                'service_id' => $request->service_id,
                'user_code' => Auth::id()
            ]);

            //fazendo o debito ou incremento nas contas de maquina virual e caixa
            Investment::check_money($request->operation_type_id, $request->amount);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovementMobileWallet  $movementMobileWallet
     * @return \Illuminate\Http\Response
     */
    public function show(MovementMobileWallet $movementMobileWallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementMobileWallet  $movementMobileWallet
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementMobileWallet $movementMobileWallet)
    {
        //
    }

    
    public function update(Request $request, MovementMobileWallet $movementMobileWallet)
    {
        //dd($request->request);
    }

    public function updateStatus(Request $request, MovementMobileWallet $movementMobileWallet)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementMobileWallet->find($request->id)->update([
                'status' => $request->status
            ]);
            return response()->json([
                'status' => $update_status,
                'id' => $request->id
            ]);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovementMobileWallet  $movementMobileWallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovementMobileWallet $movementMobileWallet)
    {
        if ($movementMobileWallet->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
