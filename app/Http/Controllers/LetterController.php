<?php

namespace App\Http\Controllers;

use App\Models\Dosya;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class LetterController extends Controller
{
    public $idLetter;
    public $letter = false;
    public $props;
    public $notification = false;

    public function __construct()
    {
        if (request('id') > 0) {
            $this->idLetter = request('id');
            $this->letter = Letter::find($this->idLetter);
        }
    }

    public function gui()
    {
        return view('letter.form', [
            'letter' => $this->letter,
        ]);
    }

    public function view()
    {
        return view('letter.view', [
            'letter' => $this->letter,
            'message' => $this->notification,
        ]);
    }

    public function dbact(Request $request)
    {
        $this->readFormValues($request);

        if ($this->idLetter) {
            $this->updateLetter();
        } else {
            $this->insertLetter();
        }

        if ($request->has('dosyalar')) {
            $this->uploadFiles($request->file('dosyalar'));
        }

        return redirect()->route('view', [
            'id' => $this->idLetter,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['toCompany'] = $request->input('to_company');
        $this->props['toPerson'] = $request->input('to_person');

        $refs = array_filter(
            $request->input('references'),
            fn($value) => !is_null($value) && $value !== ''
        );

        $this->props['references'] = implode('::', $refs);
        $this->props['subject'] = $request->input('subject');
        $this->props['content'] = $request->input('editor_data');
    }

    public function uploadFiles($dosyalar)
    {
        foreach ($dosyalar as $dosya) {
            $filename = 'USR' . Auth::id() . '/' . date('YM');
            $saved_dir = Storage::disk('local')->put($filename, $dosya);

            $this->saveFileRecord($dosya, $saved_dir);
        }
    }

    public function saveFileRecord($dosya, $saved_dir)
    {
        $dosya_data = [
            'letter_id' => $this->idLetter,
            'filename' => $dosya->getClientOriginalName(),
            'size' => $dosya->getSize(),
            'mimetype' => $dosya->getMimeType(),
            'stored_as' => $saved_dir,
        ];

        Dosya::create($dosya_data);
    }

    public function insertLetter()
    {
        $item = Letter::create($this->props);

        $this->idLetter = $item->id;
        $this->notification = [
            'status' => 'success',
            'msg' => 'Letter has been created successully',
        ];
    }

    public function updateLetter()
    {
        Letter::find($this->idLetter)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'Letter has been updated successully',
        ];
    }

    // Generate PDF
    // public function pdf()
    // {
    // $letter = $this->letter;
    // retreive all records from db
    // share data to view
    //view()->share('view', $this->letter);
    // $pdf = PDF::loadView('pdf', compact('letter'));

    // $pdf->setPaper('A4', 'portrait');
    // dd($pdf);
    // download PDF file with download method
    // return $pdf->download('pdf_file.pdf');
    // }

    public function pdf()
    {
        return view('letter.pdf-view', [
            'letter' => $this->letter,
        ]);
    }
}
