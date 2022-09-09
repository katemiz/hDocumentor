<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Image;

class Dosya extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dosyalar';

    public static function imgEncode($imagepath)
    {
        $gorsel = Image::make(Storage::path($imagepath));

        return (string) $gorsel->encode('data-url');
    }
}
