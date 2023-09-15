<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{CabChequeo};

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $fillable = ['nombre_grupo','status'];
    public $timestamps = false;

    public function cab_chequeo(){
        return $this->hasMany(CabChequeo::class);
    }
}
