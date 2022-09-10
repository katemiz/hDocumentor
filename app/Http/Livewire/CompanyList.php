<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

use Livewire\WithPagination;

class CompanyList extends Component
{
    public $columns = [
        'id' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'ID',
        ],
        'shortname' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'Name',
        ],
        'website' => [
            'show' => true,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'Web Site',
        ],

        'created_at' => [
            'show' => false,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'Created At',
        ],
        'updated_at' => [
            'show' => true,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'Last Modified At',
        ],
    ];

    public $permitted_to = [
        'view' => [
            'status' => true,
            'route' => '/company/',
        ],
        'edit' => [
            'status' => true,
            'route' => '/company-gui/',
        ],
        'delete' => [
            'status' => true,
            'route' => '/company-delete/',
        ],
        'download' => [
            'status' => true,
            'route' => '/company/',
        ],
    ];

    public $has_actions = true;

    public $sortColumn = 'id';
    public $sortDirection = 'desc';

    protected $listeners = [
        'delete' => 'deleteLetter',
    ];

    use WithPagination;

    public function render()
    {
        return view('company.list', [
            'companies' => Company::orderBy(
                $this->sortColumn,
                $this->sortDirection
            )->paginate(Config::get('constants.results_per_page')),
        ]);
    }

    public function sortBy($colname, $direction)
    {
        $this->sortColumn = $colname;
        $this->sortDirection = $direction;

        $this->columns[$colname]['sdirection'] = $direction;
    }
}
