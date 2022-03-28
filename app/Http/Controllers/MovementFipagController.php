<?php

namespace App\Http\Controllers;

use App\Models\MovementFipag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementFipagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = MovementFipag::with(['getService'])->get();
        return view('dashboard.movement-fipag', compact('movements'));
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
    public function store(Request $request, MovementFipag $movementFipag)
    {
        //return response()->json($request);
        try {
            $status = $movementFipag->create([
                'name' => $request->client_name,
                'counter_number' => $request->counter_number,
                'amount' => $request->amount,
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
     * @param  \App\Models\MovementFipag  $movementFipag
     * @return \Illuminate\Http\Response
     */
    public function show(MovementFipag $movementFipag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementFipag  $movementFipag
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementFipag $movementFipag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovementFipag  $movementFipag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovementFipag $movementFipag)
    {
        //
    }

    public function updateStatus(Request $request, MovementFipag $movementFipag)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementFipag->find($request->id)->update([
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

    
    
    public function destroy(MovementFipag $movementFipag)
    {
        if ($movementFipag->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
