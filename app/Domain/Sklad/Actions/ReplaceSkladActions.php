<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class ReplaceSkladAction{
    public function execute($params): Sklad
    {
        $sklad = Sklad::find($params['id']);
        $sklad->fill($params);
        $sklad->save();
        return $sklad;
    }
}