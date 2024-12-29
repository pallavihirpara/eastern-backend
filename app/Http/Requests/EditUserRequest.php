<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { 
        $id = decrypt($this->input('id'));
        return [
            'first_name' => 'required|regex:/^[a-zA-Z0-9]+$/|min:3|max:50',
            'last_name' => 'required|regex:/^[a-zA-Z0-9]+$/|min:3|max:50', 
            'email' => 'required|email|unique:users,email,' . $id,
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'role_id' => 'required|integer|exists:roles,id',
            'password' => 'required',
            'confirm_password' => 'required|same:password', 
            'contact_no' => 'required|numeric|min:6',
            'post_code' => 'required|numeric',
            'hobby' => 'required',
            'gender' => 'required',
            'profile.*' => 'mimes:jpg,jpeg,png|max:2048',
        ]; 
    }
}
