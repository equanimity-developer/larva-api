<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'        => ['email', 'unique:employees'],
            'first_name'   => ['string'],
            'last_name'    => ['string'],
            'phone_number' => ['string'],
            'company_id'   => ['uuid', Rule::exists('companies', 'id')],
        ];
    }
}