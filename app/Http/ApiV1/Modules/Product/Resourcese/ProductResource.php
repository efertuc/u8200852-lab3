<?php

namespace App\Http\ApiV1\Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_description' => $this->short_description,
            'actual_price' => $this->actual_price,
            'sklad_id' => $this->sklad_id,
        ];
    }
}