<?php

namespace App\Http\ApiV1\Modules\Product\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PatchProductRequest extends FormRequest
{
    protected function prepareForValidation(){
        $this->merge(['id' => $this->route('id')]);
    }
    public function rules(): array
    {
        return [
            'id' => 'integer|required|exists:products,id',
            'name' => 'string',
            'short_description' => 'string',
            'actual_price' => 'numeric',
            'sklad_id' => 'integer|exists:sklad,id',
        ];
    }
}