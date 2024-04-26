<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name', 'active'
    ];

    // protected $guarded = [];

    static function todas_las_categorias(){
        return Categories::where('active', true)->get();
    }

    static function categoria_por_id($id){
        return Categories::where('id', $id)
            ->where('active', true)
            ->firstOrFail();
    }
}
