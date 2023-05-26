<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class GetSkladAction{
    public function execute(int $id): Sklad{
        $sklad = Sklad::findOrFail($id);
        return $sklad;   
    }
}