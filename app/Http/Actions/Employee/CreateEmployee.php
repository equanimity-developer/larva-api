<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeFormRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;

class CreateEmployee extends Controller
{
    /**
     * Create an Employee
     *
     * @group Employee
     * @bodyParam first_name string required Employee's first name Example: Jan
     * @bodyParam last_name string required Employee's last name Example: Kowalski
     * @bodyParam email string required Employee's email Example: jan.kowalski@example.com
     * @bodyParam phone_number string required Employee's phone number Example: +48791000000
     * @bodyParam company_id uuid required Employee's company ID Example: 7b081c01-b5b4-4480-bf86-30e59bbed6a0
     * @responseFile 201 responses/employee/employee.json
     *
     * @param CreateEmployeeFormRequest $request
     * @return Responsable
     */
    public function __invoke(CreateEmployeeFormRequest $request): Responsable
    {
        $employee = Employee::query()->create($request->validated());

        return new EmployeeResource($employee->loadMissing('company'));
    }
}