<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectTo extends Model
{
    use HasFactory;
    protected $fillable = [
        'idWorkplace',
        'idUser'
    ];

    public function users(){

    }
}
