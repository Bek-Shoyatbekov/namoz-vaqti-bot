<?php

namespace App\View\Components;

use App\Models\City;
use Illuminate\View\Component;

class CitySearch extends Component
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
        $shahars = City::all();
        return view('components.city-search', compact("shahars"));
    }
}
