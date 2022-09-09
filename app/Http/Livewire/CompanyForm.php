<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanyForm extends Component
{
    public $idCompany = false;
    public $company = false;

    public function mount()
    {
        if (request('id') > 0) {
            $this->idCompany = request('id');
            $this->company = Company::find($this->idCompany);
        }
    }

    public function render()
    {
        return view('company.form');
    }
}
