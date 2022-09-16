<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use Livewire\Component;

class Tree extends Component
{
    public $rows = [
        [
            'id' => 100,
            'title' => 'Birinci',
            'description' => 'Satır',
        ],
        [
            'id' => 200,
            'title' => 'İkinci',
            'description' => 'Satır',
        ],
        [
            'id' => 300,
            'title' => 'Üçüncü',
            'description' => 'Satır',
        ],
        [
            'id' => 400,
            'title' => 'Dördüncü',
            'description' => 'Satır',
        ],
        [
            'id' => 500,
            'title' => 'Beşinci',
            'description' => 'Satır',
        ],
        [
            'id' => 600,
            'title' => 'Altıncı',
            'description' => 'Satır',
        ],
        [
            'id' => 700,
            'title' => 'Yedinci',
            'description' => 'Satır',
        ],
        [
            'id' => 800,
            'title' => 'Sekizinci',
            'description' => 'Satır',
        ],
    ];

    public function render()
    {
        $chapters = Chapter::all();

        $dizin = Chapter::convertToTree($chapters->toArray());

        // dd($chapters);
        return view('tree.index', [
            'chapters' => $chapters,
            'dizin' => $dizin,
        ]);
    }

    public function reorder($idArray)
    {
        // dd($idArray);
        $aa = 1;
    }
}
