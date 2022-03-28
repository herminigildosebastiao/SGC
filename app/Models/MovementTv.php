<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementTv extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tv_provider_id',
        'decoder_number',
        'amount',
        'description',
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

    public function getProvider(){
        return $this->belongsTo(TvProvider::class, 'tv_provider_id', 'id');
    }
}
