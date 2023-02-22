<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'centro_treatment', 'centro_id', 'treatment_id');
    }
}
