<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoMController extends Controller
{
    // public function __construct()
    // {
    //     if (request('id') > 0) {
    //         $this->idLetter = request('id');
    //         $this->letter = Letter::find($this->idLetter);
    //     }
    // }

    public function greet()
    {
        return view('mom.greet');
    }
}
