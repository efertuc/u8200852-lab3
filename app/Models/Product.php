<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $filltable = [
        'name',
        'short_description',
        'actual_price',
    ];

    public function sklad(){
        return $this->belongsTo(Sklad::class);
    }

    public function fill($values){
        $this->name = $values['name'] ?? null;
        $this->short_description = $values['short_description'] ?? null;
        $this->actual_price = $values['actual_price'] ?? null;
        $this->sklad_id = $values['sklad_id'] ?? null;
    }

    public function patch($values){
        $this->name = $values['name'] ?? $this->name;
        $this->short_description = $values['short_description'] ?? $this->short_description;
        $this->actual_price = $values['actual_price'] ?? $this->actual_price;
        $this->sklad_id = $values['sklad_id'] ?? $this->sklad_id;
    }
}
