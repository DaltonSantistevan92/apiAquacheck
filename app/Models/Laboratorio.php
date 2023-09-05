<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{GeolocalizacionLaboratorio,LaboratorioModulo,CabChequeo};


class Laboratorio extends Model
{
    use HasFactory;
    protected $table = 'laboratorios';
    protected $fillable = ['nombre','lugar','status'];

    public function geolocalizacion_laboratorio(){
        return $this->hasMany(GeolocalizacionLaboratorio::class);
    }

    public function laboratorio_modulo(){
        return $this->hasMany(LaboratorioModulo::class);
    }

    public function cab_chequeo(){
        return $this->hasMany(CabChequeo::class);
    }
}
