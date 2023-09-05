<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{CabChequeo};

class ChequeoTanque extends Model
{
    use HasFactory;
    protected $table = 'chequeo_tanques';
    protected $fillable = ['cab_chequeo_id','num_tanque'];
    public $timestamps = false;

    public function cab_chequeo(){
        return $this->belongsTo(CabChequeo::class);
    }
}
