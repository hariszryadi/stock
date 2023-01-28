<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrFinishedMaterialDetail extends Model
{
    use HasFactory;

    protected $fillable = ['tr_finished_material_id', 'finished_material_id', 'qty'];

    public function transaction()
    {
        return $this->belongsTo(TrFinishedMaterial::class);
    }
}
