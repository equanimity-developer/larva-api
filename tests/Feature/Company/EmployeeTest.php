<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Employee;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_employee(): void
    {
        $employee = Employee::factory()->make();
        
        $this->postJson("api/employees/", $employee->toArray())->assertSuccessful();
        
        $this->assertDatabaseHas('employees', $employee->toArray());
    }
}