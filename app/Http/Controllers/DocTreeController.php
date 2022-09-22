<?php

namespace App\Http\Controllers;

use App\Models\DocTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocTreeController extends Controller
{
    public $idDocTree = false;
    public $docTree = false;
    public $notification = false;

    public function __construct()
    {
        if (request('id') > 0) {
            $this->idDocTree = request('id');
            $this->docTree = DocTree::find($this->idDocTree);
        }
    }

    public function view()
    {
        return view('doctree.doctree-view', [
            'doctree' => $this->docTree,
            'notification' => $this->notification,
        ]);
    }

    public function db(Request $request)
    {
        $this->readFormValues($request);

        if ($this->idDocTree) {
            $this->update();
        } else {
            $this->insert();
        }

        return redirect()->route('doctreeview', [
            'id' => $this->idDocTree,
        ]);
    }

    public function readFormValues($request)
    {
        $this->props['user_id'] = Auth::id();
        $this->props['title'] = $request->input('title');
        $this->props['remarks'] = $request->input('editor_data');
    }

    public function insert()
    {
        $item = DocTree::create($this->props);

        $this->idDocTree = $item->id;
        $this->notification = [
            'status' => 'success',
            'msg' => 'Doc Tree has been created successully',
        ];
    }

    public function update()
    {
        $this->docTree = DocTree::find($this->idDocTree)->update($this->props);

        $this->notification = [
            'status' => 'success',
            'msg' => 'Doc Tree has been updated successully',
        ];
    }

    public function delete($id)
    {
        DocTree::find($id)->delete();

        $this->notification = [
            'status' => 'success',
            'msg' => 'Doc Tree has been updated successully',
        ];

        return redirect()->route('dtlist');
    }
}
