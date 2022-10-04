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
    public $action = 'welcome';

    public $chapters;

    public $form;
    public $title;
    public $content;

    protected $listeners = [
        'save' => 'saveItem',
        'add' => 'addBranch',
    ];

    public function mount()
    {
        $this->doctree = DocTree::find(request('id'));
        $this->tree =
            $this->doctree->tree == null
                ? []
                : (array) json_decode($this->doctree->tree, true);

        $this->chapters = Chapter::where('doc_tree_id', '=', $this->doctree->id)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('tree.index');
    }

    public function addBranch()
    {
        $this->action = 'gui';
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function saveItem($title, $content, $parent_id)
    {
        $props['user_id'] = Auth::id();
        $props['doc_tree_id'] = $this->doctree->id;
        $props['parent_id'] = $parent_id;
        $props['title'] = $title;
        $props['content'] = $content;

        $this->chapter = Chapter::create($props);
        $this->action = 'view';

        $new_branch = [
            'id' => $this->chapter->id,
            'parent_id' => $parent_id,
        ];

        $this->addChildToTree($new_branch);
    }

    public function addChildToTree($nodeToAdd)
    {
        // This function does not return tree but updates $this->tree with new node
        $this->doctree = DocTree::find($this->doctree->id);
        $this->tree = json_decode($this->doctree->tree, true);

        if (count($this->tree) < 1 || $nodeToAdd['parent_id'] == 0) {
            array_push($this->tree, ['id' => $nodeToAdd['id']]);
        } else {
            $this->searchTreeForChildInsert($nodeToAdd, $this->tree);
        }

        // Update DB with new tree string
        $this->doctree->update(['tree' => json_encode($this->tree)]);

        $this->doctree = DocTree::find($this->doctree->id);

        $this->chapters = Chapter::where('doc_tree_id', '=', $this->doctree->id)
            ->get()
            ->toArray();
    }

    public function searchTreeForChildInsert($nodeToAdd, &$treeArray)
    {
        foreach ($treeArray as &$dal) {
            if ($dal['id'] == $nodeToAdd['parent_id']) {
                if (isset($dal['children'])) {
                    array_push($dal['children'], ['id' => $nodeToAdd['id']]);
                } else {
                    $dal['children'] = [];
                    array_push($dal['children'], ['id' => $nodeToAdd['id']]);
                }
            } else {
                if (isset($dal['children'])) {
                    $this->searchTreeForChildInsert(
                        $nodeToAdd,
                        $dal['children']
                    );
                }
            }
        }
    }
}
