<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // NOTE: Who can create a new user?
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //TODO: Fill rest
        return
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'alpha', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:3', 'confirmed'],
                'nif' => ['required', 'numeric', 'digits:9'],
            ];
    }
}
