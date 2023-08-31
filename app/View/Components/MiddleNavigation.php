<?php

namespace App\View\Components;

use App\Models\City;
use Illuminate\View\Component;

class MiddleNavigation extends Component
{
    private City $city;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.middle-navigation', 
            [
                "city" => $this->city,
                "months" => __("public.months"),
                "months_qamar" => __("public.months_qamar"),
            ]
        );
    }
}
