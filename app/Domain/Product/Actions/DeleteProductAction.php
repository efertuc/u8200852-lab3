<?php

namespace App\Domain\Product\Actions;

use App\Models\Product;

class DeleteProductAction {
    public function execute(int $id): bool {
        if(($product = Product::find($id)) != null) {
            $product->delete();
            return true;
        }
        return false;
    }
}