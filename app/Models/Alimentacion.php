<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AnalisisMicroscopio;


class Alimentacion extends Model
{
    use HasFactory;
    protected $table = 'alimentacions';
    protected $fillable = ['nombre_alimentacion','status'];
    public $timestamps = false;

    public function analisis_microscopio(){
        return $this->hasMany(AnalisisMicroscopio::class);
    } 
}
