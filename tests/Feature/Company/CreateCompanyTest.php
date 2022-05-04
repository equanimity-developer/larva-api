<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_company(): void
    {
        $companyData = Company::factory()->make()->toArray();

        $response = $this->post(route('company.create'), $companyData);

        $response->assertCreated();
        $response->assertJsonFragment($companyData);
        $this->assertDatabaseHas('companies', $companyData);
    }

    /**
     * @test
     */
    public function it_should_not_create_company_when_nip_exists(): void
    {
        $companyData = Company::factory()->make([
            'nip' => Company::factory()->create()->nip
        ])->toArray();

        $response = $this->post(route('company.create'), $companyData);

        $response->assertSessionHasErrors('nip')
            ->assertStatus(302);
        $this->assertDatabaseMissing('companies', $companyData);
    }

    /**
     * @test
     * @dataProvider requiredFieldsList
     */
    public function it_should_not_create_company_without_required_data(string $fieldName): void
    {
        $companyData = Company::factory()->make()->toArray();
        unset($companyData[$fieldName]);

        $response = $this->post(route('company.create'), $companyData);

        $response->assertSessionHasErrors($fieldName)
            ->assertStatus(302);
        $this->assertDatabaseMissing('companies', $companyData);
    }

    public function requiredFieldsList(): array
    {
        return [
            ['name'],
            ['nip'],
            ['address'],
            ['city'],
            ['postcode'],
        ];
    }
}