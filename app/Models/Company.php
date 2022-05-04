<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Jamesh\Uuid\HasUuid;

/**
 * App\Models\Company
 *
 * @property string $id
 * @property string $name
 * @property string $nip
 * @property string $address
 * @property string $city
 * @property string $postcode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Employee[] $employees
 * @property-read int|null $employees_count
 * @method static CompanyFactory factory(...$parameters)
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static \Illuminate\Database\Query\Builder|Company onlyTrashed()
 * @method static Builder|Company query()
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereCity($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereDeletedAt($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereNip($value)
 * @method static Builder|Company wherePostcode($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Company withoutTrashed()
 */
class Company extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    protected $fillable = [
        'name',
        'nip',
        'address',
        'city',
        'postcode',
    ];

    protected $dates = ['deleted_at'];


    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleted(function (Company $company) {
            $company->employees()->delete();
        });
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
