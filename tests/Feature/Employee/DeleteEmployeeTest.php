<?php

declare(strict_types=1);

namespace Tests\Feature\Employee;

use App\Models\Employee;
use Tests\Feature\WrongUuidListProvider;
use Tests\TestCase;

class DeleteEmployeeTest extends TestCase
{
    use WrongUuidListProvider;

    /**
     * @test
     */
    public function it_should_delete_employee(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employee.delete', $employee->id));

        $response->assertSuccessful();
        $this->assertSoftDeleted('employees', $employee->toArray());
    }


    /**
     * @test
     * @dataProvider wrongUuidListProvider
     */
    public function it_should_response_not_found_code_for_wrong_employee_id($id): void
    {
        $response = $this->delete(route('employee.delete', $id));

        $response->assertStatus(404);
    }
}