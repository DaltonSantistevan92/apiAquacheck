<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{DetalleChequeo,EstadioLarval,ValorCrecimiento};

class EstadioLarvalValor extends Model
{
    use HasFactory;
    protected $table = 'estadio_larval_valors';
    protected $fillable = ['estadio_larval_id','valor_crecimiento_id'];
    public $timestamps = false;


    public function estadio_larval(){
        return $this->belongsTo(EstadioLarval::class);
    }

    public function valor_crecimiento(){
        return $this->belongsTo(ValorCrecimiento::class);
    }

    public function detalle_chequeo(){
        return $this->hasMany(DetalleChequeo::class);
    }
}
