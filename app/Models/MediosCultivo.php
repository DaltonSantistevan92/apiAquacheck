<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleChequeo;

class MediosCultivo extends Model
{
    use HasFactory;
    protected $table = 'medios_cultivos';
    protected $fillable = ['medios','abrv','status'];
    public $timestamps = false;

    public function detalle_chequeo(){
        return $this->hasMany(DetalleChequeo::class);
    }
}
