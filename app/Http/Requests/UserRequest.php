<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        $user = $this->route('user');
        if (!empty($user)) {
            return [
                'name' => 'required|unique:users,name,' . $user->id,
                'email' => 'required|unique:users,email,' . $user->id,
            ];
        }
        else {
            return [
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Name ist erforderlich',
            'name.unique' => 'Name nicht eindeutig',
            'email.required' => 'E-Mail ist erforderlich',
            'email.email' => 'E-Mail ist ungültig',
            'email.unique' => 'E-Mail nicht eindeutig',
        ];
    }
}
