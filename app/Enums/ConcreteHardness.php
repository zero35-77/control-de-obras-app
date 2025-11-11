<?php
namespace App\Enums;

enum ConcreteHardness: int
{
    case D1  = 1;
    case D3  = 3;
    case D7  = 7;
    case D14 = 14;
    case D28 = 28;

    public function percentage(): float
    {
        return match($this) {
            self::D1  => 0.16,
            self::D3  => 0.40,
            self::D7  => 0.65,
            self::D14 => 0.90,
            self::D28 => 0.99,
        };
    }

    public static function selectByDays(int $days): self
    {
        if ($days >= 28) return self::D28;
        if ($days >= 14) return self::D14;
        if ($days >= 7)  return self::D7;
        if ($days >= 3)  return self::D3;
        return self::D1;
    }
}