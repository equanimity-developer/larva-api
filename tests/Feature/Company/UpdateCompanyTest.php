<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    /**
     * @test
     * @dataProvider fieldsList
     */
    public function it_should_update_company(string $fieldName): void
    {
        $companyToUpdate = Company::factory()->create();
        $dataToUpdate = [
            $fieldName => Company::factory()->make()->{$fieldName}
        ];
        $companyNewData = $companyToUpdate->fill($dataToUpdate)->toArray();

        $response = $this->patch(route('company.update', $companyToUpdate->id), $dataToUpdate);

        $response->assertSuccessful();
        $response->assertJsonFragment($companyNewData);
        $this->assertDatabaseHas('companies', $companyNewData);
    }

    public function fieldsList(): array
    {
        return [
            ['name'],
            ['nip'],
            ['address'],
            ['city'],
            ['postcode'],
        ];
    }

    /**
     * @test
     */
    public function it_should_not_update_company_when_nip_exists(): void
    {
        $companyInDb = Company::factory()->create();
        $companyToUpdate = Company::factory()->create();

        $response = $this->patch(route('company.update', $companyToUpdate->id), ['nip' => $companyInDb->nip]);

        $response->assertSessionHasErrors('nip')
            ->assertStatus(302);
    }
}