<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;

class GetProductsAction{
    public function execute($limit, $offset){
        if($offset == null){
            $offset = 0;
        }
        if($limit == null){
            return Product::skip($offset)->get();
        }
        else{
            return Product::skip($offset)->take($limit)->get();
        } 
    }
}