<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DetalleChequeo;

class Branquia extends Model
{
    use HasFactory;
    protected $table = 'branquias';
    protected $fillable = ['nombre_branquia','status'];
    public $timestamps = false;

    public function detalle_chequeo(){
        return $this->hasMany(DetalleChequeo::class);
    }
}
