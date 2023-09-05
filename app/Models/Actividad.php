<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DetalleChequeo;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'actividads';
    protected $fillable = ['actividad','status'];
    public $timestamps = false;

    public function detalle_chequeo(){
        return $this->hasMany(DetalleChequeo::class);
    }
}
