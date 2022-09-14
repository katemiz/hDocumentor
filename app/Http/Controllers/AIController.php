<?php

namespace App\Http\Controllers;

use App\Models\ActionItem;
use App\Models\Dosya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AIController extends Controller
{
    public $idAI;
    public $idMOM = null;

    public $aitem = false;
    public $notification = false;

    public function __construct()
    {
        if (request('id') > 0) {
            $this->idAI = request('id');
            $this->aitem = ActionItem::find($this->idAI);
        }

        if (request('idMOM') > 0) {
            $this->idMOM = request('idMOM');
        }
    }

    public function view()
    {
        return view('mom.aiview', [
            'aitem' => $this->aitem,
            'notification' => $this->notification,
        ]);
    }

    public function dbact(Request $request)
    {
        $this->readFormValues($request);

        if ($this->idAI) {
            $this->updateAI();
        } else {
            $this->insertAI();
        }

        // Do we have files to be deleted ?
        $this->deleteFiles($request->input('filesToDelete'));

        if ($request->has('dosyalar')) {
            $this->uploadFiles(
                $request->file('dosyalar'),
                $request->input('filesToExclude')
            );
        }

        if ($this->idMOM) {
            return redirect()->route('momview', [
                'id' => $this->idMOM,
            ]);
        }

        return redirect()->route('aiview', [
            'id' => $this->idAI,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['mom_id'] = $this->idMOM;
        $this->props['resp_company'] = $request->input('resp_company');
        $this->props['resp_person'] = $request->input('resp_person');
        $this->props['duedate'] = $request->input('duedate');
        $this->props['description'] = $request->input('editor_data');
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
            'action_item_id' => $this->idAI,
            'filename' => $dosya->getClientOriginalName(),
            'size' => $dosya->getSize(),
            'mimetype' => $dosya->getMimeType(),
            'stored_as' => $saved_dir,
        ];

        Dosya::create($dosya_data);
    }

    public function insertAI()
    {
        $item = ActionItem::create($this->props);

        $this->idAI = $item->id;
        $this->notification = [
            'status' => 'success',
            'msg' => 'Action Item has been created successully',
        ];
    }

    public function updateAI()
    {
        $this->aitem = ActionItem::find($this->idAI)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'Action Item has been updated successully',
        ];
    }

    public function delete($id)
    {
        ActionItem::find($id)->delete();

        // Do we have any attachments?
        $dosyalar = Dosya::where('action_item_id', '=', $id);

        foreach ($dosyalar as $dosya) {
            Storage::delete($dosya->stored_as); // Delete attachment from hard disk
            Dosya::find($dosya->id)->delete($dosya->id); // Delete record from db
        }

        $this->notification = [
            'status' => 'success',
            'msg' => 'Action Item has been deleted successully',
        ];

        return redirect()->route('mom');
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
}
