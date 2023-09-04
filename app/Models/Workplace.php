<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    use HasFactory;

    public function plannings(){

        return $this->hasMany(Planning::class,'idWorkplaces');
    }
}
