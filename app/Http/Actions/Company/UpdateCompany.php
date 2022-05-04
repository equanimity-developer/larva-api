<?php

declare(strict_types=1);

namespace App\Http\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\UpdateCompanyFormRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;

class UpdateCompany extends Controller
{
    /**
     * Update a Company
     *
     * @group Company
     * @bodyParam name string Company name Example: Firma S.A.
     * @bodyParam nip string Company NIP Example: 7972226391
     * @bodyParam address string Company address Example: Gołębia 94, 32-058 Opole
     * @bodyParam city string Company city Example: Opole
     * @bodyParam postcode string Company city postcode Example: 32-058
     * @responseFile responses/company/company.json
     * @param UpdateCompanyFormRequest $request
     * @param Company $company
     * @return Responsable
     */
    public function __invoke(UpdateCompanyFormRequest $request, Company $company): Responsable
    {
        $company->update($request->validated());

        return new CompanyResource($company->loadMissing('employees'));
    }
}