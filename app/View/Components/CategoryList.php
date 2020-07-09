<?php

namespace App\View\Components;

use App\RecipeCategory;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * List of recipe categories
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = RecipeCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.category-list');
    }
}
