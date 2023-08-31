<?php

namespace App\Http\Controllers\Admin\Ramazon;

use App\Http\Controllers\Controller;
use App\Models\Ramazon;
use Illuminate\Http\Request;

class RamazonController extends Controller
{
    public function index()
    {
        $ramazon = Ramazon::orderBy("id")->first();
        return view("admin.ramazon.index", compact("ramazon"));
    }

    public function changeStatus()
    {
        try{
            $ramazon = Ramazon::orderBy("id")->first();
            $ramazon->is_published = !$ramazon->is_published;
            $ramazon->save();
            $published_text = $ramazon->is_published ? "Включено" : "Отключено";
            return redirect()->back()->with("success_message", "Состояние Рамазон изменено на: $published_text");
        } catch(\Exception $e){
            info($e->getMessage());
        }
        return redirect()->back()->with("danger_message", "Не удалось изменить состояние Рамазон");
        
    }

    public function edit(Request $request)
    {
        try
        {
            $ramazon = Ramazon::orderBy("id")->first();
            $ramazon->start_date = $request->start_date;
            $ramazon->end_date = $request->end_date;
            $ramazon->save();
            return redirect()->back()->with("success_message", "Даты рамазон изменены успешно");
        } 
        catch (\Exception $e) {
            info($e->getMessage());
        }

        return redirect()->back()->with("danger_message", "Не удалось изменить даты Рамазон");
    }

    public function create(Request $request)
    {
        if(Ramazon::count() > 0) 
            return redirect()->back()->with("warning_message", "Данные Рамазон уже имеются");

        try
        {
            $ramazon = new Ramazon();
            $ramazon->start_date = $request->start_date;
            $ramazon->end_date = $request->end_date;
            $ramazon->save();
            return redirect()->route("admin.ramazon.index")->with("success_message", "Даты рамазон изменены успешно");
        } 
        catch (\Exception $e) {
            info($e->getMessage());
        }

        return redirect()->back()->with("danger_message", "Не удалось изменить даты Рамазон");

    }

}
