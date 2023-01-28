<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBasicMaterialDetail extends Model
{
    use HasFactory;

    protected $fillable = ['tr_basic_material_id', 'basic_material_id', 'qty'];

    public function transaction()
    {
        return $this->belongsTo(TrBasicMaterial::class);
    }
}
