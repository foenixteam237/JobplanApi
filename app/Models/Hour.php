<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hour extends Model
{
    use HasFactory;

    public function programs(){
        return $this->HasMany(Program::class, 'idHour');
    }
}
