<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CekPenyakit extends Component
{

use WithFileUploads;

    public $photo;

    use WithFileUploads;
    #[Validate('image|max:10240')]
    
    public function removePhoto()
    {
        $this->photo->delete();
        $this->photo = null;
    }

    public function submit()
    {
        $this->validate();

        $this->reset('photo');
    }

    public function render()
    {
        return view('livewire.cek-penyakit');
    }
}
