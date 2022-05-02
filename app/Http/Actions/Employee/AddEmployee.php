<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\AddEmployeeFormRequest;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;

class AddEmployee extends Controller
{
    public function __invoke(AddEmployeeFormRequest $request): Responsable
    {
        $employee = Employee::query()->make($request->validated());
        $employee->save();

        return new JsonResource($employee->toArray());
    }
}