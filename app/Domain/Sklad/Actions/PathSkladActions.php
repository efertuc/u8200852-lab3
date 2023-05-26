<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class PatchSkladAction{
    public function execute($params): Sklad
    {
        $sklad = Sklad::find($params['id']);
        $sklad->patch($params);
        $sklad->save();
        return $sklad;
    }
}