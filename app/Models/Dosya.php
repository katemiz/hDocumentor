<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosya extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dosyalar';
}
