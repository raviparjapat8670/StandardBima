<?php

namespace App\Http\Requests\admin\occupation;

use Illuminate\Foundation\Http\FormRequest;

class CreateOccupationRequest extends FormRequest
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
                'title' => 'required|string',
                'status' => 'required|in:0,1',
            ];
        }

        return [];
    }
}
