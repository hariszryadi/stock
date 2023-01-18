<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBasicMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['basic_material_id', 'quantity', 'price'];

    public function basic_material()
    {
        return $this->belongsTo(BasicMaterial::class);
    }
}
