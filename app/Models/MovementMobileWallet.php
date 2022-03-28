<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementMobileWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'amount',
        'operation_type_id',
        'description',
        'status',
        'service_id',
        'user_code'
    ];

    protected $guarded = [
        'admin'
    ];

    public static function getAmountToday(){
        $deposito = self::all()->where('operation_type_id', '1')->where('status', '1')->sum('amount');
        $levantamento = self::all()->where('operation_type_id', '2')->where('status', '1')->sum('amount');
        $amount = $deposito + $levantamento;
        
        /*$deposito = number_format($deposito, 2, '.', ' '). 'MT';
        $levantamento = number_format($levantamento, 2, '.', ' ').' MT';*/
        $amount = number_format($amount, 2, '.', ' ').' MT';

        return ['deposito' => $deposito, 'levantamento' => $levantamento, 'total' => $amount];
    }

    public function getOperation(){
        return $this->belongsTo(OperationMobileWallet::class, 'operation_type_id', 'id');
    }

    public function getService(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
