<?php

namespace App\Http\ApiV1\Modules\Sklad\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkladResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_description' => $this->short_description,
            'availability' => $this->availability,
        ];
    }
}