<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{User,Laboratorio,ChequeoTanque,Modulo,DetalleChequeo,ParametrosFisicoQuimico,AnalisisMicroscopio};


class CabChequeo extends Model
{
    use HasFactory;
    protected $table = 'cab_chequeos';
    protected $fillable = [
        'user_id',
        'laboratorio_id',
        'modulo_id',
        'cantidad_reservada',
        'fecha_siembra',
        'maduraciones',
        'chequeo',
        'observacion_recomendacion',
        'fecha',
        'hora',
        'finalizado',
        'status'
    ];

    public function user(){//listo
        return $this->belongsTo(User::class);
    }

    public function laboratorio(){//listo
        return $this->belongsTo(Laboratorio::class);
    }

    public function modulo(){//listo
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function chequeo_tanque(){//listo
        return $this->hasMany(ChequeoTanque::class,'cab_chequeo_id');
    }

    public function detalle_chequeo(){//listo
        return $this->hasMany(DetalleChequeo::class,'cab_chequeo_id');
    } 

     public function parametro_fisico_quimico(){//listo
        return $this->hasMany(ParametrosFisicoQuimico::class,'cab_chequeo_id');
    } 

    public function analisis_microscopio(){//listo
        return $this->hasMany(AnalisisMicroscopio::class,'cab_chequeo_id');
    } 
}
