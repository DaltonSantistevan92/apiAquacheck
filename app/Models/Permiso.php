<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Menu,Role};

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'permisos';
    protected $fillable = ['role_id','menu_id','access','status'];
    public $timestamps = false;

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
