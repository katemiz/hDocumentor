<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\DocTree;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tree extends Component
{
    public $doctree;
    public $tree;
    public $parent_id = 0;
    public $action = 'welcome';

    public $form;
    public $title;
    public $content;

    protected $listeners = [
        'save' => 'saveItem',
    ];

    public function mount()
    {
        $this->doctree = DocTree::find(request('id'));
        $this->tree = $this->doctree->tree;
    }

    public function render()
    {
        return view('tree.index');
    }

    // public function getChapters()
    // {
    //     $this->dizin = Chapter::convertToTree($this->chapters->toArray());
    // }

    // public function treeOrder($treeOrder)
    // {
    //     $props['tree'] = $treeOrder;

    //     DocTree::find($this->idBinder)->update($props);
    // }

    public function addBranch()
    {
        $this->action = 'gui';
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function saveItem($title, $content)
    {
        $props['user_id'] = Auth::id();
        $props['doc_tree_id'] = $this->doctree->id;
        $props['parent_id'] = $this->parent_id;
        $props['title'] = $title;
        $props['content'] = $content;

        $this->chapter = Chapter::create($props);
        $this->action = 'view';

        $this->updateTree();
    }

    public function updateTree()
    {
        // $props['user_id'] = Auth::id();
        // $props['doc_tree_id'] = $this->doctree->id;
        // $props['parent_id'] = $this->parent_id;
    }
}
