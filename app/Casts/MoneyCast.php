<?php

namespace App\Casts;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class MoneyCast implements CastsAttributes
{
    protected const currency = 'SAR';

    public function __construct(protected $column = 'amount')
    {
        //
    }

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value instanceof Money) {
            return $value;
        }

        $amount = $attributes[$this->column];
        if (! $amount) {
            return null;
        }

        return Money::of(
            $amount,
            self::currency,
            roundingMode: RoundingMode::UP
        );
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (! $value instanceof Money) {
            throw new InvalidArgumentException('The given value is not an instance of Brick\Money\Money.');
        }

        return [
            $this->column => $value->getAmount(),
        ];
    }
}
