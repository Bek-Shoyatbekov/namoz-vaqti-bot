<?php

namespace App\Http\Controllers\Admin\City;

use Mobile_Detect;
use App\Models\City;
use App\Models\Region;
use App\Http\Controllers\Controller;
use App\Http\Services\SlugGenerator;
use App\Http\Requests\City\CityStoreRequest;
use App\Http\Requests\City\CityUpdateRequest;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.cities.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::orderByDesc("created_at")->get();
        return view("admin.cities.create", compact("regions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\City\CityStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        if(!$request->validated()) 
            return redirect()->back()->with("danger_message", "Не удалось добавить город");

        $translations = [
            "uz" => $request->validated()["title_uz"],
            "oz" => $request->validated()["title_oz"],
            "en" => $request->validated()["title_en"],
            "ru" => $request->validated()["title_ru"]
        ];

        $city = new City;
        $city->slug = $request->validated()["slug"];
        $city->region_id = $request->validated()["region_id"];
        $city->setTranslations("title", $translations);

        if(!$city->save())
            return redirect()->back()->with("danger_message", "Не удалось добавить город");

        return redirect()->route("admin.shahars.index")->with("success_message", "Город ". $city->translate("title", "ru"). " добавлен");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $regions = Region::with('cities')->orderByDesc("created_at")->get();
        return view("admin.cities.edit", compact("regions", "city"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\City\CityUpdateRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        if(!$request->validated())
            return redirect()->back()->with('danger_message', 'Не удалось обновить город');
        $translations = [
            'uz' => $request->validated()['title_uz'],
            'oz' => $request->validated()['title_oz'],
            'en' => $request->validated()['title_en'],
            'ru' => $request->validated()['title_ru']
        ];
        $city->slug = $request->slug;
        $city->setTranslations('title', $translations);
        if(!$city->save())        
            return redirect()->back()->with('danger_message', 'Не удалось обновить город');

        return redirect()->route('admin.shahars.index')->with('success_message', "Город " . $city->title . " успешно обновлён!" );    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if(!$city->delete()) 
            return redirect()->back()->with('danger_message', 'Не удалось удалить область');
    
        return redirect()->back()->with('success_message', "$city->title удалена");
    }

        /**
     * Checks if specified slug is valid
     * 
     */
    public function checkSlug(City $city = null)
    {
        $slugToCheck = request("slug") ?? abort(401);
        return ["isUnique" => SlugGenerator::checkCity($slugToCheck, $city === null, $city)];
    }
}
