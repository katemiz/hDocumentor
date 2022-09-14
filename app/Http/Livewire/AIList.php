<?php

namespace App\Http\Livewire;

use App\Models\ActionItem;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

use Livewire\WithPagination;

class AIList extends Component
{
    public $columns = [
        'id' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'ID',
        ],
        'description' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => true,
            'header' => 'Description',
        ],

        'duedate' => [
            'show' => true,
            'sort' => true,
            'sdirection' => 'asc',
            'html' => false,
            'header' => 'Due Date',
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
            'route' => '/ai/',
        ],
        'edit' => [
            'status' => true,
            'route' => '/ai-gui/',
        ],
        'delete' => [
            'status' => true,
            'route' => '/ai-delete/',
        ],
        'download' => [
            'status' => true,
            'route' => '/ai/',
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
        return view('mom.ai-list', [
            'ais' => ActionItem::orderBy(
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
