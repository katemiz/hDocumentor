<?php

namespace App\Http\Livewire;

use App\Models\ActionItem;
use App\Models\Mom;
use Livewire\Component;

class AIForm extends Component
{
    public $idAI = false;
    public $idMOM = 0;
    public $mom;

    public $ai = false;

    public function mount()
    {
        if (request('id') > 0) {
            $this->idAI = request('id');
            $this->ai = ActionItem::find($this->idAI);
        }

        if (request('idMOM') > 0) {
            $this->idMOM = request('idMOM');
            $this->mom = Mom::find($this->idMOM);
        }
    }

    public function render()
    {
        return view('mom.aiform');
    }
}
