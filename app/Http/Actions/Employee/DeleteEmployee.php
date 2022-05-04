<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteEmployee extends Controller
{
    /**
     * Delete an Employee
     *
     * @group Employee
     *
     * @param Employee $employee
     * @return Responsable
     */
    public function __invoke(Employee $employee): Responsable
    {
        $employee->delete();

        return new JsonResource([]);
    }
}