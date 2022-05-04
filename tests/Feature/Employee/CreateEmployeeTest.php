<?php

declare(strict_types=1);

namespace Tests\Feature\Employee;

use App\Models\Employee;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_employee(): void
    {
        $employeeData = Employee::factory()->make()->toArray();

        $response = $this->post(route('employee.create'), $employeeData);

        $response->assertCreated();
        $response->assertJsonFragment($employeeData);
        $this->assertDatabaseHas('employees', $employeeData);
    }

    /**
     * @test
     */
    public function it_should_not_create_employee_when_email_exists(): void
    {
        $employeeData = Employee::factory()->make([
            'email' => Employee::factory()->create()->email
        ])->toArray();

        $response = $this->post(route('employee.create'), $employeeData);

        $response->assertSessionHasErrors('email')
            ->assertStatus(302);
        $this->assertDatabaseMissing('employees', $employeeData);
    }

    /**
     * @test
     */
    public function it_should_not_create_employee_when_company_does_not_exist(): void
    {
        /** @var Employee $employee */
        $employee = Employee::factory()->make([
            'company_id' => Str::uuid()
        ]);

        $response = $this->post(route('employee.create'), $employee->toArray());

        $response->assertSessionHasErrors('company_id')
            ->assertStatus(302);
        $this->assertDatabaseMissing('employees', $employee->toArray());
    }

    /**
     * @test
     * @dataProvider requiredFieldsList
     */
    public function it_should_not_create_employee_without_required_data(string $fieldName): void
    {
        $employeeData = Employee::factory()->make()->toArray();
        unset($employeeData[$fieldName]);

        $response = $this->post(route('employee.create'), $employeeData);

        $response->assertSessionHasErrors($fieldName)
            ->assertStatus(302);
        $this->assertDatabaseMissing('employees', $employeeData);
    }

    public function requiredFieldsList(): array
    {
        return [
            ['first_name'],
            ['last_name'],
            ['email'],
        ];
    }
}