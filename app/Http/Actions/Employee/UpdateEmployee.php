<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateEmployeeFormRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;

class UpdateEmployee extends Controller
{
    /**
     * Create an Employee
     *
     * @group Employee
     * @bodyParam first_name string Employee's first name Example: Jan
     * @bodyParam last_name string Employee's last name Example: Kowalski
     * @bodyParam email string Employee's email Example: jan.kowalski@example.com
     * @bodyParam phone_number string Employee's phone number Example: +48791000000
     * @bodyParam company_id uuid Employee's company ID Example: 7b081c01-b5b4-4480-bf86-30e59bbed6a0
     * @responseFile responses/employee/employee.json
     *
     * @param UpdateEmployeeFormRequest $request
     * @param Employee $employee
     * @return Responsable
     */
    public function __invoke(UpdateEmployeeFormRequest $request, Employee $employee): Responsable
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee->loadMissing('company'));
    }
}