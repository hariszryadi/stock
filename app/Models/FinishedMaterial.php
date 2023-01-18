<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function detail()
    {
        return $this->hasOne(DetailFinishedMaterial::class);
    }
}
