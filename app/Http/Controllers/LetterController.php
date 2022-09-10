<?php

namespace App\Http\Controllers;

use App\Models\Dosya;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'senders' => $this->senders,
        ]);
    }

    public function view()
    {
        return view('letter.view', [
            'letter' => $this->letter,
            'notification' => $this->notification,
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

        // Do we have files to be deleted ?
        $this->deleteFiles($request->input('filesToDelete'));

        if ($request->has('dosyalar')) {
            $this->uploadFiles(
                $request->file('dosyalar'),
                $request->input('filesToExclude')
            );
        }

        return redirect()->route('view', [
            'id' => $this->idLetter,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['company_id'] = $request->input('sender');
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

    public function uploadFiles($dosyalar, $toBeExcludedFiles)
    {
        $excludeFilesArray = [];

        if ($toBeExcludedFiles != 0) {
            $excludeFilesArray = explode('::', $toBeExcludedFiles);
        }

        foreach ($dosyalar as $dosya) {
            if (
                !in_array($dosya->getClientOriginalName(), $excludeFilesArray)
            ) {
                $filename = 'USR' . Auth::id() . '/' . date('YM');
                $saved_dir = Storage::disk('local')->put($filename, $dosya);

                $this->saveFileRecord($dosya, $saved_dir);
            }
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
        $this->letter = Letter::find($this->idLetter)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'Letter has been updated successully',
        ];
    }

    public function deleteLetter($id)
    {
        Letter::find($id)->delete();

        // Do we have any attachments?
        $dosyalar = Dosya::where('letter_id', '=', $id);

        foreach ($dosyalar as $dosya) {
            Storage::delete($dosya->stored_as); // Delete attachment from hard disk
            Dosya::find($dosya->id)->delete($dosya->id); // Delete record from db
        }

        $this->notification = [
            'status' => 'success',
            'msg' => 'Letter has been deleted successully',
        ];
    }

    function deleteFiles($fileIdDizinToDelete)
    {
        if ($fileIdDizinToDelete == 0) {
            return true;
        }

        $idDizin = json_decode($fileIdDizinToDelete);

        foreach ($idDizin as $id) {
            $d = Dosya::find($id);

            // Delete file from hard disk
            Storage::delete($d->stored_as);

            // delete item from db
            $d->delete();
        }

        return true;
    }

    public function pdf()
    {
        return view('letter.pdf-view', [
            'letter' => $this->letter,
        ]);
    }

    public function sign()
    {
        $this->props['status'] = 'signed';

        $this->updateLetter();

        $this->notification = [
            'status' => 'success',
            'msg' => 'Letter has been signed successully',
        ];

        return view('letter.view', [
            'letter' => $this->letter,
            'notification' => $this->notification,
        ]);
    }
}
