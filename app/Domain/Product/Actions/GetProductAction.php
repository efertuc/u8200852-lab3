<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;

class GetProductAction{
    public function execute(int $id): Product{
        $product = Product::findOrFail($id);
        return $product;   
    }
}