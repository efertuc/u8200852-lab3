<?php

namespace App\Domain\Sklad\Actions;

use App\Models\Sklad;

class GetSkladAction{
    public function execute($limit, $offset){
        if($offset == null){
            $offset = 0;
        }
        if($limit == null){
            return Sklad::skip($offset)->get();
        }
        else{
            return Sklad::skip($offset)->take($limit)->get();
        } 
    }
}