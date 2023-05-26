<?php

namespace App\Http\ApiV1\Modules\Sklad\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSkladRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'short_description' => 'string|required',
            'availability' => 'string',
        ];
    }
}