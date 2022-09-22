<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTree extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'doctrees';

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
