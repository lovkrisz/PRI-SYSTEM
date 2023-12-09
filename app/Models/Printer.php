<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "ip_addr",
        "type",
        "brand",
        "location",
    ];
    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
