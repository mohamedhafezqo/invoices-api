<?php

namespace App\Service\Constant;

/**
 * Class InvoiceStatus
 *
 * @package App\Service\Constant
 */
final class InvoiceStatus
{
    const PENDING = 1;
    const ON_HOLD = 2;
    const PAID = 3;

    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return [
            self::PAID,
            self::ON_HOLD,
            self::PAID,
        ];
    }
}
