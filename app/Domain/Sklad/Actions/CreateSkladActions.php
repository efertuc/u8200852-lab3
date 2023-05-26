<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class CreateSkladAction{
    public function execute($params): Sklad
    {
        $sklad = new Sklad;
        $sklad->fill($params);
        $sklad->save();
        return $sklad;
    }
}