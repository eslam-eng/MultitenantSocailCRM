<?php

namespace App\Http\Requests\Tenant;

use App\Enum\ActivationStatusEnum;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends BaseFormRequest
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
    public function rules()
    {

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('tenant.groups', 'name')->ignore($this->role)],
            'is_active' => 'required|boolean',
            'description' => 'nullable|string|max:190',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->get('status', ActivationStatusEnum::ACTIVE->value),
        ]);
    }
}
