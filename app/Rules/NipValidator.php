<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NipValidator implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return true;
        }

        $value = preg_replace('/\D+/', '', $value);

        if (strlen($value) !== 10) {
            return false;
        }

        $digits = str_split($value);
        $checksum = (6 * (int) $digits[0] + 5 * (int) $digits[1] + 7 * (int) $digits[2] + 2 * (int) $digits[3] +
                3 * (int) $digits[4] + 4 * (int) $digits[5] + 5 * (int) $digits[6] + 6 * (int) $digits[7] +
                7 * (int) $digits[8]) % 11;

        return ((int) $digits[9] === $checksum);
    }

    public function message(): string
    {
        return __('validation.nip_invalid');
    }
}
