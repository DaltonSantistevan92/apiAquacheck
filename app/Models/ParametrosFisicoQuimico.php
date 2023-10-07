<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CabChequeo;

class ParametrosFisicoQuimico extends Model
{
    use HasFactory;
    protected $table = 'parametros_fisico_quimicos';
    protected $fillable = ['cab_chequeo_id','salinidad','temperatura','alcalinidad','ph'];
    public $timestamps = false;

    public function cab_chequeo(){
        return $this->belongsTo(CabChequeo::class);
    }
}
