<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEmployeeFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'   => ['required', 'string'],
            'last_name'    => ['required', 'string'],
            'email'        => ['required', 'email', 'unique:employees'],
            'phone_number' => ['string'],
            'company_id'   => ['required', 'uuid', Rule::exists('companies', 'id')],
        ];
    }
}