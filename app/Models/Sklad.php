<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sklad extends Model
{
    use HasFactory;
    protected $table = 'sklads';

    protected $filltable = [
        'name',
        'short_description',
        'availability',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function fill($values){
        $this->name = $values['name'] ?? null;
        $this->short_description = $values['short_description'] ?? null;
        $this->availability = $values['availability'] ?? null;
    }

    //TODO : подумать куда перенести или оставить
    public function patch($values){
        $this->name = $values['name'] ?? $this->name;
        $this->short_description = $values['short_description'] ?? $this->short_description;
        $this->availability = $values['availability'] ?? $this->availability;
    }
}
