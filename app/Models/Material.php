<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public static function getMaterialsToday(){
        $material = count(self::all());
        if ($material <= 9) {
            $material = '0'.$material;
        }
        return $material;
    }

    public function getCategory(){
        return $this->belongsTo(MaterialCategory::class, 'material_category_id', 'id');
    }
}
