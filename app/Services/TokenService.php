<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class TokenService
{
    private const REPLACE_CHARTS = [
        '0' => 'O',
        '1' => '7',
        'l' => 'I',
        '5' => 'S',
        '2' => 'Z',
        '8' => 'B',
        '9' => 'G',
        'V' => 'U',
        'Q' => 'O'
    ];

    public function createToken(): string
    {
        $token = strtoupper(Str::random(7));

        return $this->makeReadable($token);
    }

    public function makeReadable(string $token): string
    {
        return str_replace(array_keys(self::REPLACE_CHARTS), array_values(self::REPLACE_CHARTS), $token);
    }
}
