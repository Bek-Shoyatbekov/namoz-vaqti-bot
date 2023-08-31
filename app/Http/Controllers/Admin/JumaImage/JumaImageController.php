<?php

namespace App\Http\Controllers\Admin\JumaImage;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class JumaImageController extends Controller
{
    public function index()
    {
        $image = \App\Models\JumaImage::query()->inRandomOrder()->first();

        return $image->path;

    }
}
