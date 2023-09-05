<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Sexo,User};

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = ['sexo_id','identification','first_name','last_name','cell_phone','address','status'];
    public $timestamps = false;

    public function sexo(){
        return $this->belongsTo(Sexo::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
