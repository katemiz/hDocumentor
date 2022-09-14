<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\SelfReferenceTrait;

class Chapter extends Model
{
    use HasFactory;

    use SelfReferenceTrait;

    protected $guarded = [];
    protected $table = 'chapters';

    public function getParent()
    {
        return $this->parent();
    }
}
