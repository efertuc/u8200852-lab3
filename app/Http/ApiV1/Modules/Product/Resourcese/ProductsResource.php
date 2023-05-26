<?php

namespace App\Http\ApiV1\Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'data' => ProductResource::collection($this),
        ];
    }
}