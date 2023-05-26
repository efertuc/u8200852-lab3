<?php

namespace App\Http\ApiV1\Modules\Sklad\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkladsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'data' => SkladResource::collection($this),
        ];
    }
}