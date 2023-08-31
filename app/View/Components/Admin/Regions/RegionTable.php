<?php

namespace App\View\Components\Admin\Regions;

use App\Models\Region;
use Illuminate\View\Component;

class RegionTable extends Component
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
        $regions = Region::with('cities')->orderByDesc('id')->paginate();
        return view('components.admin.regions.region-table', compact('regions'));
    }
}
