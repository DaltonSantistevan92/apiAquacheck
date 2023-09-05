<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EstadioLarvalValor;

class EstadioLarval extends Model
{
    use HasFactory;
    protected $table = 'estadio_larvals';
    protected $fillable = ['nombre_estadio','status'];
    public $timestamps = false;


    public function estadio_larval_valor(){
        return $this-> hasMany(EstadioLarvalValor::class);
    }
}
