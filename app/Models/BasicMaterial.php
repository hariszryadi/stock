<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'qty', 'price', 'unit'];
}
