<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneratedTime extends Model
{
    use HasFactory;

    protected $table = 'generated_time';

    protected $guarded = [];

    public function city() {
        return $this->belongsTo(City::class);
    }

    protected $casts = [
        "gregorian_date" => "date:Y-m-d",
        "qamar_date" => "date:Y-m-d",
    ];
}
