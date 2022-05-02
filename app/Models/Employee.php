<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class Employee extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'phone_number',
    ];
}
