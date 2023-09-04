<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'week',
        'idMonth',
        'idUser'
    ];

    public function programs(){
        return $this->hasMany(Program::class, 'idPlanning');
    }

    public function users(){
        return $this->belongsTo(User::class, 'by');
    }

    public function months(){
        return $this->belongsTo(Month::class, 'idMonth');
    }
}
