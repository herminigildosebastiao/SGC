<?php

namespace App\Http\Controllers;

use App\Models\MovementInformatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementInformaticController extends Controller
{
    
    public function index()
    {
        $movements = MovementInformatic::with(['getService'])->get();
        return view('dashboard.movement-informatic', compact('movements'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeAll(Request $request, MovementInformatic $movementInformatic){

        
        try {
            $newmovement = $movementInformatic->create([
                'amount' => $request->element['amount'],
                'status' => '1',
                'service_id' => $request->element['id'],
                'user_code' => Auth::id()
            ]);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }

        //dd($newmovement);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovementInformatic  $movementInformatic
     * @return \Illuminate\Http\Response
     */
    public function show(MovementInformatic $movementInformatic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementInformatic  $movementInformatic
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementInformatic $movementInformatic)
    {
        //
    }

    
    public function update(Request $request, MovementInformatic $movementInformatic)
    {
        //
    }

    public function updateStatus(Request $request, MovementInformatic $movementInformatic)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementInformatic->find($request->id)->update([
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
     * @param  \App\Models\MovementInformatic  $movementInformatic
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovementInformatic $movementInformatic)
    {
        if ($movementInformatic->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
