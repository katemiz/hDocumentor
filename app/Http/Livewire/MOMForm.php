<?php

namespace App\Http\Livewire;

use App\Models\Mom;
use Livewire\Component;

class MOMForm extends Component
{
    public $idMOM = false;
    public $mom;

    public function mount()
    {
        if (request('idMOM') > 0) {
            $this->mom = Mom::find($this->idMOM);
        }

        if (request('id') > 0) {
            $this->idAI = request('id');
        }
    }

    public function render()
    {
        return view('mom.mom-form');
    }
}
