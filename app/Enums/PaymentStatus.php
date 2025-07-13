<?php

namespace App\Enums;

use Closure;

//  TODO: Add colors
// use Filament\Support\Colors\Color;

enum PaymentStatus: string
{
    case pending = 'pending';
    case paid = 'paid';
    case failed = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::pending => 'Pending',
            self::paid => 'Paid',
            self::failed => 'Failed',
        };
    }

    // public function color(): string|array|bool|Closure|null
    // {
    //     return match ($this) {
    //         self::pending => Color::hex('#FFA500'),
    //         self::paid => Color::hex('#28A745'),
    //         self::failed => Color::hex('#DC3545'),
    //     };
    // }

    public static function values(): array
    {
        return array_map(fn($e) => $e->value, self::cases());
    }
}
