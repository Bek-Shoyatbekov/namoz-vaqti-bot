<?php

namespace App\Http\Controllers\Admin\Region;

use App\Models\Region;
use App\Http\Controllers\Controller;
use App\Http\Services\SlugGenerator;
use App\Http\Requests\Region\RegionStoreRequest;
use App\Http\Requests\Region\RegionUpdateRequest;



class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.regions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Region\RegionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionStoreRequest $request)
    {
        if(!$request->validated())
            return redirect()->back()->with('danger_message', 'Не удалось добавить область');
        $translations = [
            'uz' => $request->validated()['title_uz'],
            'oz' => $request->validated()['title_oz'],
            'en' => $request->validated()['title_en'],
            'ru' => $request->validated()['title_ru']
        ];
        $region = new Region;
        $region->slug = $request->validated()['slug'];
        $region->setTranslations('title', $translations);
        if(!$region->save())        
            return redirect()->back()->with('danger_message', 'Не удалось добавить область');

        return redirect()->route('admin.viloyats.index')->with('success_message', "Область " . $region->title . " успешно добавлена!" );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Region\RegionUpdateRequest  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionUpdateRequest $request, Region $region)
    {
        if(!$request->validated())
            return redirect()->back()->with('danger_message', 'Не удалось обновить область');
        $translations = [
            'uz' => $request->validated()['title_uz'],
            'oz' => $request->validated()['title_oz'],
            'en' => $request->validated()['title_en'],
            'ru' => $request->validated()['title_ru']
        ];
        $region->slug = $request->slug;
        $region->setTranslations('title', $translations);
        if(!$region->save())        
            return redirect()->back()->with('danger_message', 'Не удалось обновить область');

        return redirect()->route('admin.viloyats.index')->with('success_message', "Область " . $region->title . " успешно обновлена!" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        if(!$region->delete()) 
            return redirect()->back()->with('danger_message', 'Не удалось удалить область');
        
        return redirect()->back()->with('success_message', "$region->title удалена");
    }


    /**
     * Checks if specified slug is valid
     * 
     */
    public function checkSlug(Region $region = null)
    {
        $slugToCheck = request('slug') ?? abort(401);
        return ['isUnique' => SlugGenerator::checkRegion($slugToCheck, $region === null, $region)];
    }
}
