<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceUsage extends Model
{
    use HasFactory;
    protected $fillable = [
        "printer_id",
        "resource_barcode"
    ];
}
