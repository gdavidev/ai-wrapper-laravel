<?php

namespace App\View\Components\FileSistem;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Folder extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.file-sistem.folder');
    }
}
