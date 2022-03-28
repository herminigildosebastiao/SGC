<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lable',
        'amount'
    ];

    protected $guarded = ['admin'];

    public static function getAmountToday(){
        $investment = self::find(1)->amount;
        $virtual = self::find(2)->amount;
        $fisic = self::find(3)->amount;
        //$amountCoin = self::getAmountCoin();
        //$divid = ($virtual + $amountCoin) - $investment;

        
        /*$investment = number_format($investment, 2, '.', ' '). ' MT';
        $virtual = number_format($virtual, 2, '.', ' '). ' MT';
        $fisic = number_format($fisic, 2, '.', ' '). ' MT';*/
    return ['investment' => $investment, 'virtual' => $virtual, 'fisic' => $fisic,/* 'amountCoin' => $amountCoin, 'divid' =>$divid*/];
    }

    /*public function getAmountCoin(){
        $amounts = DB::table('coins')->get();

        $total = 0;
        foreach ($amounts as $amount) {
            $total = $total + ($amount->value * $amount->quantity);
        }
        return $total;

    }*/

    public static function check_money($id_operation, $amount){
        $result = null;
        try {
            $type_operation = DB::table('operation_mobile_wallets')->find($id_operation);
            $virtual = self::find(2);
            $fisic = self::find(3);

            if ($type_operation->code == 162301) {
                //dd('codigo: '.$type_operation->code.  ' vou retirar '. $amount. ' MT na maquina e acrescentar no cofre '. $amount. ' MT');
                $decrement = $virtual->amount - $amount;
                $virtual = $virtual->update([
                    'amount' => $decrement
                ]);

                $increment = $fisic->amount + $amount;
                $fisic = $fisic->update([
                    'amount' => $increment
                ]);

            } elseif($type_operation->code == 162302) {
                //dd('codigo: '.$type_operation->code.  ' vou acrescentar '. $amount. ' MT na maquina e retirar no cofre '. $amount. ' MT');

                $increment =  $virtual->amount + $amount;;
                $virtual = $virtual->update([
                    'amount' => $increment
                ]);

                $decrement = $fisic->amount - $amount;
                $fisic = $fisic->update([
                    'amount' => $decrement
                ]);
            }
            $result = true;
        } catch (\Throwable $th) {
            $result = false;
        }
        
        return $result;
    }

}
