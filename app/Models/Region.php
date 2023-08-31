<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Region extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $fillable = ['slug', 'title'];
    public $translatable = ['title'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
