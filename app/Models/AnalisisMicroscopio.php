<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{CabChequeo,Dieta,Alimentacion,Lipido,Musculo};


class AnalisisMicroscopio extends Model
{
    use HasFactory;
    protected $table = 'analisis_microscopios';
    protected $fillable = [
        'cab_chequeo_id',
        'dieta_id',
        'alimentacion_id',
        'lipido_id',
        'semillenas',
        'estres',
        'musculo_id',
        'opacidad',
        'necrosis',
        'flacidez',
        'bacteria_filamentosas',
        'protozoos',
        'hongos'
    ];
    public $timestamps = false;

    public function cab_chequeo(){//listo
        return $this->belongsTo(CabChequeo::class);
    }

    public function dieta(){
        return $this->belongsTo(Dieta::class);
    }

    public function alimentacion(){
        return $this->belongsTo(Alimentacion::class);
    }

    public function lipido(){
        return $this->belongsTo(Lipido::class);
    }

    public function musculo(){
        return $this->belongsTo(Musculo::class);
    }
}
