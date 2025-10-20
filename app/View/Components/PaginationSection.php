<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginationSection extends Component
{
    public LengthAwarePaginator $data;

    public function __construct(LengthAwarePaginator $data)
    {
        $this->data = $data;
    }

    public function render(): View|Closure|string
    {
        $data = $this->data;
        return view('admin.components.pagination-section', compact('data'));
    }
}
