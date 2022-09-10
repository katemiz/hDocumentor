<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Dosya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public $idCompany;
    public $company = false;
    public $props;
    public $notification = false;

    public function __construct()
    {
        if (request('id') > 0) {
            $this->idCompany = request('id');
            $this->company = Company::find($this->idCompany);
        }
    }

    public function view()
    {
        //dd($this->company->logos);
        return view('company.view', [
            'company' => $this->company,
            'message' => $this->notification,
        ]);
    }

    public function dbact(Request $request)
    {
        $this->readFormValues($request);

        if ($this->idCompany) {
            $this->updateCompany();
        } else {
            $this->insertCompany();
        }

        if ($request->has('dosyalar')) {
            $this->uploadFiles(
                $request->file('dosyalar'),
                $request->input('filesToExclude')
            );
        }

        // Do we have files to be deleted ?
        $this->deleteFiles($request->input('filesToDelete'));

        return redirect()->route('cview', [
            'id' => $this->idCompany,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['is_mycompany'] = $request->input('is_mycompany');
        $this->props['shortname'] = $request->input('shortname');
        $this->props['fullname'] = $request->input('fullname');
        //$this->props['description'] = $request->input('description');
        //$this->props['motto'] = $request->input('motto');
        $this->props['website'] = $request->input('website');
        $this->props['phone'] = $request->input('phone');
        $this->props['email'] = $request->input('email');
        $this->props['tax_no'] = $request->input('tax_no');
        $this->props['address'] = $request->input('editor_data');
        //$this->props['disclaimer'] = $request->input('disclaimer');
    }

    public function insertCompany()
    {
        $item = Company::create($this->props);

        $this->idCompany = $item->id;
        $this->notification = [
            'status' => 'success',
            'msg' => 'Company has been created successully',
        ];
    }

    public function updateCompany()
    {
        Company::find($this->idCompany)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'Company has been updated successully',
        ];
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
            'company_id' => $this->idCompany,
            'filename' => $dosya->getClientOriginalName(),
            'size' => $dosya->getSize(),
            'mimetype' => $dosya->getMimeType(),
            'stored_as' => $saved_dir,
        ];

        Dosya::create($dosya_data);
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
