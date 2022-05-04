<?php

declare(strict_types=1);

namespace Tests\Feature\Employee;

use App\Models\Employee;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateEmployeeTest extends TestCase
{
    /**
     * @test
     * @dataProvider fieldsList
     */
    public function it_should_update_employee(string $fieldName): void
    {
        $employeeToUpdate = Employee::factory()->create();
        $dataToUpdate = [
            $fieldName => Employee::factory()->make()->{$fieldName}
        ];
        $employeeNewData = $employeeToUpdate->fill($dataToUpdate)->toArray();

        $response = $this->patch(route('employee.update', $employeeToUpdate->id), $dataToUpdate);

        $response->assertSuccessful();
        $response->assertJsonFragment($employeeNewData);
        $this->assertDatabaseHas('employees', $employeeNewData);
    }

    public function fieldsList(): array
    {
        return [
            ['first_name'],
            ['last_name'],
            ['email'],
        ];
    }

    /**
     * @test
     */
    public function it_should_not_update_employee_when_company_does_not_exist(): void
    {
        $employeeInDb = Employee::factory()->create();
        $newEmployeeData = Employee::factory()->make([
            'company_id' => Str::uuid()
        ])->toArray();

        $response = $this->patch(route('employee.update', $employeeInDb->id), $newEmployeeData);

        $response->assertSessionHasErrors('company_id')
            ->assertStatus(302);
        $this->assertDatabaseMissing('employees', $newEmployeeData);
    }

    /**
     * @test
     */
    public function it_should_not_update_employee_when_email_exists(): void
    {
        $employeeInDb = Employee::factory()->create();
        $employeeToUpdate = Employee::factory()->create();

        $response = $this->patch(route('employee.update', $employeeToUpdate->id), ['email' => $employeeInDb->email]);

        $response->assertSessionHasErrors('email')
            ->assertStatus(302);
    }
}