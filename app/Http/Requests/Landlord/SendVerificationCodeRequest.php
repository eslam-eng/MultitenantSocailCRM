<?php

namespace App\Http\Requests\Landlord;

use App\Enum\VerificationCodeType;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class SendVerificationCodeRequest extends BaseFormRequest
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
            'email' => 'required|email',
            'type' => ['required', Rule::in(VerificationCodeType::values())],
        ];
    }
}
