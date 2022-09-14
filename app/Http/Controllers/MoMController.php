<?php

namespace App\Http\Controllers;

use App\Models\Dosya;
use App\Models\Mom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MoMController extends Controller
{
    public $idMOM;
    public $mom;

    public $notification = false;

    public function __construct()
    {
        if (request('id') > 0) {
            $this->idMOM = request('id');
            $this->mom = Mom::find($this->idMOM);
        }
    }

    public function greet()
    {
        return view('mom.greet');
    }

    public function view()
    {
        return view('mom.mom-view', [
            'mom' => $this->mom,
            'notification' => $this->notification,
        ]);
    }

    public function dbact(Request $request)
    {
        $this->readFormValues($request);

        if ($this->idMOM) {
            $this->update();
        } else {
            $this->insert();
        }

        // Do we have files to be deleted ?
        $this->deleteFiles($request->input('filesToDelete'));

        if ($request->has('dosyalar')) {
            $this->uploadFiles(
                $request->file('dosyalar'),
                $request->input('filesToExclude')
            );
        }

        return redirect()->route('momview', [
            'id' => $this->idMOM,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['place'] = $request->input('place');
        $this->props['startdate'] = $request->input('startdate');
        $this->props['finishdate'] = $request->input('finishdate');
        $this->props['subject'] = $request->input('subject');
        $this->props['minutes'] = $request->input('editor_data');
    }

    public function insert()
    {
        $this->mom = Mom::create($this->props);

        $this->idMOM = $this->mom->id;
        $this->notification = [
            'status' => 'success',
            'msg' => 'MOM has been created successully',
        ];
    }

    public function update()
    {
        $this->mom = Mom::find($this->idMOM)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'MOM has been updated successully',
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
            'mom_id' => $this->idMOM,
            'filename' => $dosya->getClientOriginalName(),
            'size' => $dosya->getSize(),
            'mimetype' => $dosya->getMimeType(),
            'stored_as' => $saved_dir,
        ];

        Dosya::create($dosya_data);
    }
}
