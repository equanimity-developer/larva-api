<?php

declare(strict_types=1);

namespace Tests\Feature\Employee;

use App\Models\Employee;
use Tests\TestCase;

class GetAllEmployeesTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_all_employees(): void
    {
        $employees = Employee::factory()->count(5)->create();

        $response = $this->get(route('employee.get-all'));

        $response->assertSuccessful();
        $employees->each(fn (Employee $employee) => $response->assertJsonFragment($employee->toArray()));
    }
}