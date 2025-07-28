<?php

namespace App\Enum;

enum SubscriptionStatusEnum: int
{
    case PENDING = 0;

    case ACTIVE = 1;
    case TRIAL = 2;
    case CANCELED = 3;
    case EXPIRED = 4;
    case SUSPENDED = 5;
    case PAST_DUE = 6;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => __('app.limit'),
            self::ACTIVE => __('app.feature'),
            self::CANCELED => __('app.feature'),
            self::EXPIRED => __('app.feature'),
            self::SUSPENDED => __('app.feature'),
            self::PAST_DUE => __('app.feature'),
        };
    }

    public static function inactive(): array
    {
        return [
            self::PENDING->value,
            self::CANCELED->value,
            self::EXPIRED->value,
            self::PAST_DUE->value,
            self::SUSPENDED->value,
        ];
    }
}
