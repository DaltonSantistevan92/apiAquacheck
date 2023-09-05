<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{CabChequeo, OrigenNauplio, Actividad, EstadioLarvalValor, Branquia, MediosCultivo} ;


class DetalleChequeo extends Model
{
    use HasFactory;
    protected $table = 'detalle_chequeos';
    protected $fillable = [
        'cab_chequeo_id',
        'tanque_anterior',
        'origen_nauplio_id',
        'actividad_id',
        'cantidad_sembrada',
        'tq_capacidad_tn',
        'nivel_actual_tn',
        'poblacion_actual',
        'larvas_por_litros',
        'dias_de_cultivo',
        'dias_de_post_larva',
        'estadio_larval_valor_id',
        'branquia_id',
        'pl_gr',
        'larvas_azuladas',
        'bact_luminiscente',
        'medios_cultivo_id'
    ];
    public $timestamps = false;

    public function cab_chequeo(){//listo
        return $this->belongsTo(CabChequeo::class);
    }

    public function origen_nauplio(){//listo
        return $this->belongsTo(OrigenNauplio::class);
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }

    public function estadio_larval_valor(){
        return $this->belongsTo(EstadioLarvalValor::class);
    }

    public function branquia(){
        return $this->belongsTo(Branquia::class);
    }

    public function medios_cultivo(){
        return $this->belongsTo(MediosCultivo::class);
    }
}
