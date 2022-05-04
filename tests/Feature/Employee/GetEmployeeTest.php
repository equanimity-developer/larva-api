<?php

declare(strict_types=1);

namespace Tests\Feature\Employee;

use App\Models\Company;
use App\Models\Employee;
use Tests\Feature\WrongUuidListProvider;
use Tests\TestCase;

class GetEmployeeTest extends TestCase
{
    use WrongUuidListProvider;

    /**
     * @test
     */
    public function it_should_get_employee_with_company(): void
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create([
            'company_id' => $company->id
        ]);

        $response = $this->get(route('employee.get', $employee->id));

        $response->assertSuccessful();
        $response->assertJsonFragment($employee->toArray());
        $response->assertJsonFragment($company->toArray());
    }

    /**
     * @test
     * @dataProvider wrongUuidListProvider
     */
    public function it_should_response_not_found_code_for_wrong_employee_id($id): void
    {
        $response = $this->get(route('employee.get', $id));

        $response->assertStatus(404);
    }
}