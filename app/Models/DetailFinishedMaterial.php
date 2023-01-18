<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFinishedMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['finished_material_id', 'quantity', 'price'];

    public function finished_material()
    {
        return $this->belongsTo(FinishedMaterial::class);
    }
}
