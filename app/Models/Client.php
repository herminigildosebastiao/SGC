<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public static function getClients(){
        $clients = count(self::all());
        if ($clients <= 9) {
            $clients = '0'.$clients;
        }
        return $clients;
    }

    public function getTypeDoc(){
        return $this->belongsTo(TypeDoc::class, 'type_doc_id', 'id');
    }
}
