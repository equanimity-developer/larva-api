<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;

class GetAllEmployees extends Controller
{
    /**
     * Get all Employees
     *
     * @group Employee
     * @responseFile responses/employee/employees.json
     *
     * @return Responsable
     */
    public function __invoke(): Responsable
    {
        return EmployeeResource::collection(Employee::all()->loadMissing('company'));
    }
}