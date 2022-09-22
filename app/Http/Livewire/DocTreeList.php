<?php

namespace App\Http\Livewire;

use App\Models\DocTree;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

use Livewire\WithPagination;

class DocTreeList extends Component
{
    public $columns = [
        'id' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'ID',
        ],
        'subject' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'Subject',
        ],
        'place' => [
            'show' => true,
            'sort' => true,
            'html' => false,
            'sdirection' => 'asc',
            'header' => 'Place',
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
            'route' => '/mom/',
        ],
        'edit' => [
            'status' => true,
            'route' => '/mom-gui/',
        ],
        'delete' => [
            'status' => true,
            'route' => '/mom-delete/',
        ],
        'download' => [
            'status' => true,
            'route' => '/mom/',
        ],
    ];

    public $has_actions = true;

    public $sortColumn = 'id';
    public $sortDirection = 'desc';

    public $notification = false;

    use WithPagination;

    public function render()
    {
        return view('doctree.doctree-list', [
            'doctrees' => DocTree::orderBy(
                $this->sortColumn,
                $this->sortDirection
            )->paginate(Config::get('constants.results_per_page')),
        ]);
    }
}
