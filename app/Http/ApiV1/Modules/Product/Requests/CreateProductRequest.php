<?php

namespace App\Http\ApiV1\Modules\Product\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'short_description' => 'string|required',
            'actual_price' => 'numeric|required',
            'sklad_id' => 'integer|required|exists:sklad,id',
        ];
    }

    // используется response из Handler.php
}