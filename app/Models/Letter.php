<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'letter';

    public function dosyalar()
    {
        return $this->hasMany(Dosya::class);
    }


    protected function refarray(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>explode('::',$this->references)
        );
    }


    protected function tarih(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>$this->created_at->format('d M Y')
        );
    }


    protected function letterno(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>'B'.$this->created_at->format('Ym').'-'.$this->id
        );
    }

    protected function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }


}
