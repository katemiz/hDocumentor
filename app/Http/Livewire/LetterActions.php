<?php

namespace App\Http\Livewire;

use App\Models\Letter;
use Livewire\Component;

class LetterActions extends Component
{
    public $idLetter = false;
    public $letter = false;
    public $noOfReferences = 1;

    public function mount()
    {
        if (request('id') > 0) {
            $this->idLetter = request('id');
            $this->letter = Letter::find($this->idLetter);

            $this->noOfReferences = count($this->letter->refarray);
        }
    }

    public function render()
    {
        return view('letter.form');
    }

    public function addRef()
    {
        ++$this->noOfReferences;
    }
}
