<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'active', 'category_id'
    ];

    // protected $guarded = [];

    static function todas_las_notas(){
        return Note::where('active', true)->get();
    }

    static function nota_por_id($id){
        return Note::where('id', $id)
            ->where('active', true)
            ->firstOrFail();
    }
}