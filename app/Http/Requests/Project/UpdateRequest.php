<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|min:8|unique:projects,slug,' . $this->project->id,
            'description' => 'nullable',
            'is_active' => 'sometimes|required|in:on,0',
        ];
    }
}
