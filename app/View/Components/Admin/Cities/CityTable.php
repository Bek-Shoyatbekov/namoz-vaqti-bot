<?php

namespace App\View\Components\Admin\Cities;

use App\Models\City;
use Illuminate\View\Component;

class CityTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $cities = City::orderByDesc("id")->with('region')->paginate(20);
        return view('components.admin.cities.city-table', compact('cities'));
    }
}
