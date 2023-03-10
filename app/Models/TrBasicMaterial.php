<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBasicMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['invoice', 'date', 'status', 'category'];

    public function detail()
    {
        return $this->hasMany(TrBasicMaterialDetail::class);
    }
}
