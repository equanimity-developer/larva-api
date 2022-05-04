<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Models\Company;
use App\Rules\NipValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['string'],
            'nip'      => ['string', new NipValidator(), Rule::unique(Company::class)->ignore($this->route()->id)],
            'address'  => ['string'],
            'city'     => ['string'],
            'postcode' => ['string'],
        ];
    }
}