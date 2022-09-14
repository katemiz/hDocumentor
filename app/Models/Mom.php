<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mom extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'moms';

    // public function author()
    // {
    //     return $this->hasMany(User::class);
    // }


    public function aitems()
    {
        return $this->hasMany(ActionItem::class);
    }

    public function dosyalar()
    {
        return $this->hasMany(Dosya::class);
    }

    protected function author(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>User::find($this->user_id)
        );
    }

}
