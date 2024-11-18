<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Home extends Component
{
    public $previewFilePath;

    public function mount() {
        $this->previewFilePath = Storage::url("documents/index.html");
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
