<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Person;

class Sexo extends Model
{
    use HasFactory;

    protected $table = 'sexos';
    protected $fillable = ['sex','status'];
    public $timestamps = false;

    public function person(){
        return $this->hasMany(Person::class);
    }
}
