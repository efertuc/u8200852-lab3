<?php

namespace App\Http\ApiV1\Modules\Sklad\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReplaceSkladRequest extends FormRequest
{
    protected function prepareForValidation(){
        $this->merge(['id' => $this->route('id')]);
    }
    public function rules(): array
    {
        return [
            'id' => 'integer|required|exists:products,id',
            'name' => 'string|required',
            'short_description' => 'string|required',
            'availability' => 'string',
        ];
    }
}