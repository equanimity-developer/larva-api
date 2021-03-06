<?php

declare(strict_types=1);

namespace App\Http\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;

class GetCompany extends Controller
{
    /**
     * Get a Company
     *
     * @group Company
     * @responseFile responses/company/company.json
     * @param Company $company
     * @return Responsable
     */
    public function __invoke(Company $company): Responsable
    {
        return new CompanyResource($company->loadMissing('employees'));
    }
}