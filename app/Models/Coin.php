<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    public static function getCoinsToday(){
        $coin = count(self::all());
        if ($coin <= 9) {
            $coin = '0'.$coin;
        }
        return $coin;
    }
}
