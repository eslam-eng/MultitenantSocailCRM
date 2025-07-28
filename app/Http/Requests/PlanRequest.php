<?php

namespace App\Http\Requests;

use App\Enum\SubscriptionDurationEnum;
use App\Rules\ValidCurrencyCode;
use Illuminate\Validation\Rule;

class PlanRequest extends BaseFormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('plans', 'name')->ignore($this->plan),
            ],
            'description' => 'string|nullable',
            'price' => 'numeric|required|min:0',
            'billing_cycle' => ['required', Rule::in(SubscriptionDurationEnum::values())],
            'is_active' => 'required|boolean',
            'trial_days' => 'required|integer|min:1',
            'currency_code' => ['required', 'string', new ValidCurrencyCode],
            'refund_days' => 'nullable|integer|min:0',
            'features' => 'array|nullable|min:1',
            'limits' => 'array|nullable|min:1',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'currency_code' => 'USD'
        ]);
    }
}
