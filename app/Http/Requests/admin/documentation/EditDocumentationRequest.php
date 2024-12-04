<?php

namespace App\Http\Requests\admin\documentation;

use Illuminate\Foundation\Http\FormRequest;

class EditDocumentationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // Only apply validation rules if the request is a POST request
         if ($this->isMethod('post')) {
            return [
                'name' => 'required|string',
                'description' => 'required|string|max:100',
                'mandatory' => 'required|in:0,1',
                'status' => 'required|in:0,1',
            ];
        }

        return [];
    }
}
