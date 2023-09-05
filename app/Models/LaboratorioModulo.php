<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Laboratorio,Modulo};

class LaboratorioModulo extends Model
{
    use HasFactory;
    protected $table = 'laboratorio_modulos';
    protected $fillable = ['laboratorio_id','modulo_id'];
    public $timestamps = false;

    public function laboratorio(){
        return $this->belongsTo(Laboratorio::class);
    }

    public function modulo(){
        return $this->belongsTo(Modulo::class);
    }
}
