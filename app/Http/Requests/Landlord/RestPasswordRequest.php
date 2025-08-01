<?php

namespace App\Http\Requests\Landlord;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\Password;

class RestPasswordRequest extends BaseFormRequest
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
        return [
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()],
        ];
    }
}
