<?php

declare(strict_types=1);

namespace App\Http\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;

class GetAllCompanies extends Controller
{
    /**
     * Get all Companies
     *
     * @group Company
     * @responseFile responses/company/companies.json
     * @return Responsable
     */
    public function __invoke(): Responsable
    {
        return CompanyResource::collection(Company::all()->loadMissing('employees'));
    }
}