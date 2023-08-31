<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class JumaImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "path"
    ];

    public function getPathAttribute($value)
    {
        return env("APP_URL", "https://namozvaqti.uz") . Storage::url($value);
    }
}
