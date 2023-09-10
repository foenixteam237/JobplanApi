<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workplace extends Model
{
    use HasFactory;

    public function plannings(){

        return $this->hasMany(Planning::class,'idWorkplaces');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'affect_tos','idWorkplace','idUser');
    }

    public function units():BelongsTo{
        
        return $this->belongsTo(Unit::class,'idUnit');
}
}
