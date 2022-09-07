<?php

namespace App\Http\Livewire;

use App\Models\Letter;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

use Livewire\WithPagination;

class LetterList extends Component
{
    public $columns = [
        'id' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'ID',
        ],
        'toCompany' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'To Company',
        ],
        'toPerson' => [
            'show' => true,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'To Person',
        ],
        'subject' => [
            'show' => true,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'Letter Subject',
        ],
        'content' => [
            'show' => false,
            'sort' => true,
            'html' => true,
            'sdirection' => 'asc',
            'header' => 'Letter Content',
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
            'route' => '/letter/',
        ],
        'edit' => [
            'status' => true,
            'route' => '/letter-gui/',
        ],
        'delete' => [
            'status' => true,
            'route' => '/letter-delete/',
        ],
        'download' => [
            'status' => true,
            'route' => '/letter/',
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
        return view('letter.list', [
            'letters' => Letter::orderBy(
                $this->sortColumn,
                $this->sortDirection
            )->paginate(Config::get('constants.results_per_page')),
        ]);
    }

    public function sortBy($colname, $direction)
    {
        //dd('id');

        $this->sortColumn = $colname;
        $this->sortDirection = $direction;

        $this->columns[$colname]['sdirection'] = $direction;
    }
}
