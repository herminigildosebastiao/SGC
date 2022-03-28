<?php

namespace App\Http\Controllers;

use App\Models\MovementCredelec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementCredelecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = MovementCredelec::with(['getService'])->get();
        return view('dashboard.movement-credelec', compact('movements'));
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
    public function store(Request $request, MovementCredelec $movementCredelec)
    {
        try {
            $status = $movementCredelec->create([
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
     * @param  \App\Models\MovementCredelec  $movementCredelec
     * @return \Illuminate\Http\Response
     */
    public function show(MovementCredelec $movementCredelec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovementCredelec  $movementCredelec
     * @return \Illuminate\Http\Response
     */
    public function edit(MovementCredelec $movementCredelec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovementCredelec  $movementCredelec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovementCredelec $movementCredelec)
    {
        //
    }

    public function updateStatus(Request $request, MovementCredelec $movementCredelec)
    {
        try {
            //dd($movementMobileWallet->find($request->id));
            
            $update_status = $movementCredelec->find($request->id)->update([
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
     * @param  \App\Models\MovementCredelec  $movementCredelec
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovementCredelec $movementCredelec)
    {
        if ($movementCredelec->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
