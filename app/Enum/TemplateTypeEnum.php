<?php

namespace App\Enum;

enum TemplateTypeEnum: string
{
    case EMAIL = 'email';
    case WHATSAPP = 'whatsapp';

    public function label(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::WHATSAPP => 'WhatsApp',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::EMAIL => 'mail',
            self::WHATSAPP => 'message-circle',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
