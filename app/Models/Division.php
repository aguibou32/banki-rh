<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function responsable()
    {
        return $this->hasOne(User::class);
    }

    public function départements()
    {
        return $this->hasMany(Departement::class);
    }
}
