<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aitems';

    public function dosyalar()
    {
        return $this->hasMany(Dosya::class);
    }
}
