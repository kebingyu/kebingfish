<?php

namespace App\Http\Requests\Signup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class EventRequest extends FormRequest
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
        return [
            'type' => 'in:1,2',
            'title' => 'required|max:255',
            'description' => 'max:255',
            'expires_at' => 'date|after_now',
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'A valid event type is required.',
            'title.required' => 'A title is required.',
            'expires_at.after_now' => 'Must pick a date after today.',
        ];
    }
}
