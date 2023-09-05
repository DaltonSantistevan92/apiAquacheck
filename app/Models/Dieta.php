<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AnalisisMicroscopio;


class Dieta extends Model
{
    use HasFactory;
    protected $table = 'dietas';
    protected $fillable = ['nombre_dieta','abrv','status'];
    public $timestamps = false;

    public function analisis_microscopio(){
        return $this->hasMany(AnalisisMicroscopio::class);
    } 
}
