<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class DeleteSkladAction {
    public function execute(int $id): bool {
        if(($sklad = Sklad::find($id)) != null) {
            $sklad->products()->each(function($product){
                $product->delete();
            });
            $sklad->delete();
            return true;
        }
        return false;
    }
}