<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use App\Traits\SelfReferenceTrait;

class Chapter extends Model
{
    use HasFactory;

    // use SelfReferenceTrait;

    protected $guarded = [];
    protected $table = 'chapters';

    // public function getParent()
    // {
    //     return $this->parent();
    // }

    public static function convertToTree(array $array)
    {
        $indexed = [];
        // first pass - get the array indexed by the primary id
        foreach ($array as $row) {
            $row['level'] = 0;
            $indexed[$row['id']] = $row;
            $indexed[$row['id']]['children'] = [];
        }

        // second pass
        $root = [];
        foreach ($indexed as $id => $row) {
            $pid = $indexed[$id]['parent_id'];

            if ($pid == 0) {
                $indexed[$id]['level'] = 0;
            } else {
                $indexed[$id]['level'] = $indexed[$pid]['level'] + 1;
            }

            $indexed[$row['parent_id']]['children'][] = &$indexed[$id];

            if (!$row['parent_id']) {
                $root[] = &$indexed[$id];
            }
        }
        return $root;
    }

    // One level child
    public function child()
    {
        return $this->hasMany(Chapter::class, 'parent_id');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany(Chapter::class, 'parent_id')->with('children');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo(Chapter::class, 'parent_id');
    }

    // Recursive parents
    public function parents()
    {
        return $this->belongsTo(Chapter::class, 'parent_id')->with('parent');
    }

    public function getPathAttribute()
    {
        $path = [];
        if ($this->parent_id) {
            $parent = $this->parent;
            $parent_path = $parent->path;
            $path = array_merge($path, $parent_path);
        }
        $path[] = $this->name;
        return $path;
    }
}
