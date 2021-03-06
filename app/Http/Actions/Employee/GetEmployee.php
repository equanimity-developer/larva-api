<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;

class GetEmployee extends Controller
{
    /**
     * Get an Employee
     *
     * @group Employee
     * @responseFile responses/employee/employee.json
     *
     * @param Employee $employee
     * @return Responsable
     */
    public function __invoke(Employee $employee): Responsable
    {
        return new EmployeeResource($employee->loadMissing('company'));
    }
}