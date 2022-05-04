<?php

declare(strict_types=1);

namespace App\Http\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyFormRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;

class CreateCompany extends Controller
{
    /**
     * Create a Company
     *
     * @group Company
     * @bodyParam name string required Company name Example: Firma S.A.
     * @bodyParam nip string required Company NIP Example: 7972226391
     * @bodyParam address string required Company address Example: Gołębia 94, 32-058 Opole
     * @bodyParam city string required Company city Example: Opole
     * @bodyParam postcode string required Company city postcode Example: 32-058
     * @responseFile 201 responses/company/company.json
     *
     * @param CreateCompanyFormRequest $request
     * @return Responsable
     */
    public function __invoke(CreateCompanyFormRequest $request): Responsable
    {
        $company = Company::query()->create($request->validated());

        return new CompanyResource($company->loadMissing('employees'));
    }
}