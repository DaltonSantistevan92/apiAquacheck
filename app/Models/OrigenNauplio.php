<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DetalleChequeo;

class OrigenNauplio extends Model
{
    use HasFactory;
    protected $table = 'origen_nauplios';
    protected $fillable = ['nauplio','abrv','status'];
    public $timestamps = false;

    public function detalle_chequeo(){
        return $this->hasMany(DetalleChequeo::class);
    }
}
