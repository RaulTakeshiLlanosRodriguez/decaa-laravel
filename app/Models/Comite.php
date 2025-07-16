<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    protected $fillable = ['carrera'];

    public function miembros()
    {
        return $this->hasMany(Miembro::class);
    }
}
