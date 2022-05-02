<?php

declare(strict_types=1);

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'        => ['required'],
            'first_name'   => ['required'],
            'last_name'    => ['required'],
            'phone_number' => ['required'],
        ];
    }
}