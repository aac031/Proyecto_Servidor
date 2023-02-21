<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'telefono', 'email'];

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'socio_treatment')->withPivot('id', 'fecha_tratamiento');
    }

    public function socio_treatments()
    {
        return $this->hasMany(SocioTreatment::class);
    }

    public function precioTotal()
    {
        $total = 0;

        foreach ($this->treatments as $treatment) {
            $total += $treatment->price;
        }

        return $total;
    }
}
