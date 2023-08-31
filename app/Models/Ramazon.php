<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramazon extends Model
{
    use HasFactory;

    protected $table = "ramazon";

    protected $fillable = [
        "is_published",
        "start_date",
        "end_date"
    ];

}
