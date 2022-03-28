<?php

namespace App\Http\Controllers;

use App\Models\MovementTv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementTvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = MovementTv::with(['getService', 'getProvider'])->get();
        return view('dashboard.movement-tv', compact('movements'));
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

    
    public function store(Request $request, MovementTv $movementTv)
    {
        //return response()->json($request);
        try {
            $status = $movementTv->create([
                'name' => $request->client_name,
                'decoder_number' => $request->decoder_number,
                'amount' => $request->amount,
                'tv_provider_id' => $request->provider_tv,
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
     * @param  \App\Models\MovementTv  $movementTv
     * @return \Illuminate\Http\Response
     */
    public function show(MovementTv $movementTv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementTv  $movementTv
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementTv $movementTv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovementTv  $movementTv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovementTv $movementTv)
    {
        //
    }

    public function updateStatus(Request $request, MovementTv $movementTv)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementTv->find($request->id)->update([
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

    
    public function destroy(MovementTv $movementTv)
    {
        if ($movementTv->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
