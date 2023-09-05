<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Permiso,User};

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['role','status'];
    public $timestamps = false;

    public function permiso(){
        return $this->hasMany(Permiso::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
