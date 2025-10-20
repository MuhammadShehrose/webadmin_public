<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableActions extends Component
{
    public $viewUrl, $editUrl, $deleteUrl, $restoreUrl, $forceDeleteUrl;
    public $viewPermission, $editPermission, $deletePermission, $restorePermission, $forceDeletePermission;
    /**
     * Create a new component instance.
     */
    public function __construct($viewUrl = null, $editUrl = null, $deleteUrl = null, $restoreUrl = null, $forceDeleteUrl = null, $viewPermission = null, $editPermission = null, $deletePermission = null, $restorePermission = null, $forceDeletePermission = null)
    {
        $this->viewUrl = $viewUrl;
        $this->editUrl = $editUrl;
        $this->deleteUrl = $deleteUrl;
        $this->restoreUrl = $restoreUrl;
        $this->forceDeleteUrl = $forceDeleteUrl;

        $this->viewPermission = $viewPermission;
        $this->editPermission = $editPermission;
        $this->deletePermission = $deletePermission;
        $this->restorePermission = $restorePermission;
        $this->forceDeletePermission = $forceDeletePermission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.components.table-actions');
    }
}
