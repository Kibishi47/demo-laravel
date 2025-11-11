<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|min:8|unique:projects,slug',
            'description' => 'nullable',
        ];
    }
}
