<?php

namespace App\Http\Controllers;

use App\Models\MovementMobileRecharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementMobileRechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = MovementMobileRecharge::with(['getService', 'getProvider'])->get();
        return view('dashboard.movement-mobile-recharge', compact('movements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request, MovementMobileRecharge $movementMobileRecharge)
    {
        try {
            $status = $movementMobileRecharge->create([
                'amount' => $request->amount,
                'mobile_provider_id' => $request->mobile_provider,
                'status' => '1',
                'service_id' => $request->service_id,
                'user_code' => Auth::id()
            ]);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovementMobileRecharge  $movementMobileRecharge
     * @return \Illuminate\Http\Response
     */
    public function show(MovementMobileRecharge $movementMobileRecharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementMobileRecharge  $movementMobileRecharge
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementMobileRecharge $movementMobileRecharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovementMobileRecharge  $movementMobileRecharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovementMobileRecharge $movementMobileRecharge)
    {
        //
    }

    public function updateStatus(Request $request, MovementMobileRecharge $movementMobileRecharge)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementMobileRecharge->find($request->id)->update([
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

    
    
    public function destroy(MovementMobileRecharge $movementMobileRecharge)
    {
        if ($movementMobileRecharge->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
