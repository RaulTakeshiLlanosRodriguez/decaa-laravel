<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    protected $fillable = ['comite_id', 'rol', 'nombre'];

    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }
}
