<?php

namespace App\View\Components;

use Closure;
use App\Models\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $collections = Collection::select(["name", "slug"])->get();
        return view("components.layout", compact("collections"));
    }
}
