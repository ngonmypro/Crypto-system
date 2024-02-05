<?php
namespace App\Enums;

final class TypeName
{
    const BUY = 'BUY';
    const SELL = 'SELL';
    const WITHDRAW = 'WITHDRAW';
    const DEPOSIT = 'DEPOSIT';

    const ALL_TYPE = [
        self::BUY,
        self::SELL,
        self::WITHDRAW,
        self::DEPOSIT,
    ];

    const ORDER_TYPE = [
        self::BUY,
        self::SELL,
    ];

    const TRANSFER_TYPE = [
        self::WITHDRAW,
        self::DEPOSIT,
    ];
}
