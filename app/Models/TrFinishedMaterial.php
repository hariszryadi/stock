<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrFinishedMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['invoice', 'date', 'status'];

    public function detail()
    {
        return $this->hasMany(TrFinishedMaterialDetail::class);
    }
}
