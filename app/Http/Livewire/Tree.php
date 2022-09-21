<?php

namespace App\Http\Livewire;

use App\Models\Binder;
use App\Models\Chapter;
use Livewire\Component;

class Tree extends Component
{
    public $idBinder;
    public $binder;

    public function render()
    {
        $this->getChapters();

        return view('tree.index');
    }

    public function getChapters()
    {
        $this->dizin = Chapter::convertToTree($this->chapters->toArray());
    }

    public function treeOrder($treeOrder)
    {
        $props['tree'] = $treeOrder;

        Binder::find($this->idBinder)->update($props);
    }
}
