<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Rules\NipValidator;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string'],
            'nip'      => ['required', new NipValidator(), 'unique:companies'],
            'address'  => ['required', 'string'],
            'city'     => ['required', 'string'],
            'postcode' => ['required', 'string'],
        ];
    }
}