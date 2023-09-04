<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'idPlanning',
        'idDay',
        'idHour',

    ];

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function plannings(){
        return $this->belongsTo(Planning::class, 'idPlanning');
    }

    public function days(){
        return $this->belongsTo(Day::class, 'idDay');
    }

    public function hours(){
        return $this->belongsTo(Hour::class, 'idHour');
    }
}
