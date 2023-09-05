<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AnalisisMicroscopio;

class Lipido extends Model
{
    use HasFactory;
    protected $table = 'lipidos';
    protected $fillable = ['valor_lipido','status'];
    public $timestamps = false;


    public function analisis_microscopio(){
        return $this->hasMany(AnalisisMicroscopio::class);
    } 
}
