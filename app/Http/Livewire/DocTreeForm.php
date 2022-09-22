<?php

namespace App\Http\Livewire;

use App\Models\DocTree;
use Livewire\Component;

class DocTreeForm extends Component
{
    public $idDocTree = false;
    public $docTree = false;

    public function mount()
    {
        if (request('id') > 0) {
            $this->idDocTree = request('id');
            $this->docTree = DocTree::find($this->idDocTree);
        }
    }

    public function render()
    {
        return view('doctree.doctree-form');
    }
}
