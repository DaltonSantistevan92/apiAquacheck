<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Laboratorio};


class GeolocalizacionLaboratorio extends Model
{
    use HasFactory;
    protected $table = 'geolocalizacion_laboratorios';
    protected $fillable = ['laboratorio_id','latitud','longitud'];
    public $timestamps = false;

    public function laboratorio(){
        return $this->belongsTo(Laboratorio::class);
    }
}
