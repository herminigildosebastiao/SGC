<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    private $name = 'denny';

    public static function getServicesToday(){
        $service = count(self::all());
        if ($service <= 9) {
            $service = '0'.$service;
        }
        return $service;
    }

    public function getCategory(){
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function getPrices(){
        return $this->hasMany(Price::class, 'service_id', 'id');
    }
}
