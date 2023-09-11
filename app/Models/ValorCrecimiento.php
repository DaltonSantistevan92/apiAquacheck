<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstadioLarvalValor;

class ValorCrecimiento extends Model
{
    use HasFactory;
    protected $table = 'valor_crecimientos';
    protected $fillable = ['valor','status'];
    public $timestamps = false;

    public function estadio_larval_valor(){
        return $this->hasMany(EstadioLarvalValor::class);
    }
}
