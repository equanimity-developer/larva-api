<?php

declare(strict_types=1);

namespace App\Http\Actions\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteCompany extends Controller
{
    /**
     * Delete a Company
     *
     * @group Company
     *
     * @param Company $company
     * @return Responsable
     */
    public function __invoke(Company $company): Responsable
    {
        $company->delete();

        return new JsonResource([]);
    }
}