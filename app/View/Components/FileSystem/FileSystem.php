<?php

namespace App\View\Components\FileSystem;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\File;

class FileSystem extends Component
{
    public $tree = [];

    public function index() {
        // $path = public_path('files');
        // $this->tree = $this->getDirectoryTree($path);

        // return view("components.file-system.file-system", ['tree' => $this->tree]);
    }

    public function render(): View|Closure|string {
        $path = public_path('files');
        $this->tree = $this->getDirectoryTree($path);

        return view('components.file-system.file-system', ['tree' => $this->tree]);
    }

    private function getDirectoryTree($directory) {
        $tree = [];

        foreach (File::directories($directory) as $dir) {
            $tree[basename($dir)] =  $this->getDirectoryTree($dir);
        }
        foreach (File::allFiles($directory) as $file) {
            $tree[] = basename($file);
        }

        return $tree;
    }
}
