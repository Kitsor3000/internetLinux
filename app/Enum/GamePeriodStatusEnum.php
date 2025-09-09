<?php

declare(strict_types=1);

namespace App\Enum;

enum GamePeriodStatusEnum: string
{
    case DRAFT = 'DRAFT';
    case PLANNED = 'PLANNED';
    case PLAYING = 'PLAYING';
    case FINISHED = 'FINISHED';

    public static function getList(): array
    {
        $list = [];

        foreach (self::cases() as $case) {
            $list[$case->name] = $case->value;
        }

        return $list;
    }
}
