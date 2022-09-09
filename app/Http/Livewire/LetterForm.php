<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LetterForm extends Component
{
    public $idLetter = false;
    public $letter = false;
    public $noOfReferences = 1;
    public $senders;

    public function mount()
    {
        if (request('id') > 0) {
            $this->idLetter = request('id');
            $this->letter = Letter::find($this->idLetter);

            $this->noOfReferences = count($this->letter->refarray);
        }

        $this->senders = Company::where('user_id', '=', Auth::id())
            ->where('is_mycompany', true)
            ->get();
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
