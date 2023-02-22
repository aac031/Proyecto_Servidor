<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'type'];

    public function socios()
    {
        return $this->belongsToMany(Socio::class)->withPivot('id', 'fecha_tratamiento');
    }

    public function centros()
    {
        return $this->belongsToMany(Centro::class, 'centro_treatment', 'treatment_id', 'centro_id');
    }
}
