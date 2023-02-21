<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocioTreatment extends Model
{
    protected $table = 'socio_treatment';
    protected $primaryKey = 'id';
    protected $fillable = ['socio_id', 'treatment_id', 'fecha_tratamiento'];
    public $timestamps = false;

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function treatment()
    {
        return $this->belongsToMany(Treatment::class)
            ->using(SocioTreatment::class)
            ->withPivot('id', 'fecha_tratamiento');
    }
}
