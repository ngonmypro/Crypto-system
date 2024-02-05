<?php
namespace App\Enums;

final class StatusName
{
    const OPEN      = 'OPEN';
    const PENDING   = 'PENDING';
    const COMPLETE  = 'COMPLETE';
    const CLOSE     = 'CLOSE';
    const CANCEL    = 'CANCEL';

    const ALL_STATUSES = [
        self::OPEN,
        self::PENDING,
        self::COMPLETE,
        self::CLOSE,
        self::CANCEL,
    ];

    const PAYMENT_STATUSES = [
        self::OPEN,
        self::PENDING,
        self::COMPLETE,
    ];

    const ORDER_STATUSES = [
        self::OPEN,
        self::CLOSE,
    ];

    const TRANSFER_STATUSES = [
        self::OPEN,
        self::PENDING,
        self::COMPLETE,
    ];
}

