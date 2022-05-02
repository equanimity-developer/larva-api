<?php

declare(strict_types=1);

namespace App\Http\Actions\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class GetEmployee extends Controller
{
    public function __invoke(FormRequest $request): Responsable
    {
        $employee = Employee::query()->make($request->validated());

        return new JsonResource($employee);
    }
}