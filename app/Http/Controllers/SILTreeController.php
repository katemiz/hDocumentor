<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreeController extends Controller
{
    public $dizin = [
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

    public function index()
    {
        return view('tree.index', [
            'rows' => $this->dizin,
        ]);
    }
}
