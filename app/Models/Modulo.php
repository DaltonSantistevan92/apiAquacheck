<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{LaboratorioModulo,CabChequeo};


class Modulo extends Model
{
    use HasFactory;
    protected $table = 'modulos';
    protected $fillable = ['nombre_modulo','status'];
    public $timestamps = false;

    public function laboratorio_modulo(){
        return $this->hasMany(LaboratorioModulo::class);
    }

    public function cab_chequeo(){
        return $this->hasMany(CabChequeo::class);
    }
}
