<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementCredelec extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'counter_number',
        'description',
        'amount',
        'status',
        'service_id',
        'user_code'
    ];

    public static function getAmountToday(){
        $amount = self::all()->where('status', '1')->sum('amount');
        //$amount = number_format($amount, 2, '.', ' ');
        return $amount;
    }

    public function getService(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
