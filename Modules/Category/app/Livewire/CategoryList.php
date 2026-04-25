<?php

namespace Modules\Category\App\Livewire;

use Livewire\Component;
use Modules\Category\App\Models\Category;

class CategoryList extends Component
{
    public string $search = '';

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%'.$this->search.'%')
            )
            ->get();

        return view('category::livewire.category-list', compact('categories'));
    }
}