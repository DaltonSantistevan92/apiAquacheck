<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AnalisisMicroscopio;

class Musculo extends Model
{
    use HasFactory;
    protected $table = 'musculos';
    protected $fillable = ['detalle','status'];
    public $timestamps = false;


    public function analisis_microscopio(){
        return $this->hasMany(AnalisisMicroscopio::class);
    } 
}
