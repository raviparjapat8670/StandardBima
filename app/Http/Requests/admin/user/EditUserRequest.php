<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // Only apply validation rules if the request is a POST request
        if ($this->isMethod('post')) {
            return [
                'fname' => 'required|string|max:20',
                'lname' => 'required|string|max:20',
                'role' => 'required|in:superadmin,manager,staff,administ',
                'gender' => 'required|in:male,female,other',
            ];
        }

        return [];
    }
}
