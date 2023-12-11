<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leltar extends Model
{
    use HasFactory;
    protected $fillable = [
        "barcode",
        "amount"
    ];
}
