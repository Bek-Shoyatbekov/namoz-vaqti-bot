<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintime extends Model
{
    use HasFactory;

    protected $fillable = ["greg_date", "qamar_date", "tong", "quyosh", "peshin", "asr", "shom", "hufton"];
}
