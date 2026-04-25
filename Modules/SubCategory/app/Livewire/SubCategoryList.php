<?php

namespace Modules\SubCategory\App\Livewire;

use Livewire\Component;
use Modules\Category\App\Models\Category;

class SubCategoryList extends Component
{
    public string $search = '';
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $subCategories = $this->category->subCategories()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%'.$this->search.'%')
            )
            ->get();

        return view('subcategory::livewire.subcategory-list', compact('subCategories'));
    }
}
