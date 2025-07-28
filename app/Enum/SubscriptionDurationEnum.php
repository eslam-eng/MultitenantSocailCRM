<?php

namespace App\Enum;

enum SubscriptionDurationEnum: string
{
    case DAY = 'day';
    case MONTHLY = 'month';
    case YEAR = 'year';
    case LIFE_TIME = 'life time';

    public function getLabel(): string
    {
        return match ($this) {
            self::DAY => __('lang.active'),
            self::MONTHLY => __('lang.inactive'),
            self::YEAR => __('lang.inactive'),
            self::LIFE_TIME => __('lang.inactive'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
