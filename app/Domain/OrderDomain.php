<?php

namespace App\Domain;

use App\Enums\StatusName;

class OrderDomain
{
    public function setFormatOrderByCrypto($crypto, $orderDetails, $resultExchange)
    {
        $orderIds   = [];
        $trades     = [];
        $payments   = [];
        $symbol     = $crypto;

        foreach ($orderDetails as $rowOrder) {
            if ($rowOrder->status == StatusName::OPEN) {

                if (!isset($payments[$rowOrder->username])) {
                    $payments[$rowOrder->username] = [];

                    array_push($payments[$rowOrder->username], $rowOrder->payment);
                } else {
                    if (!in_array($rowOrder->payment, $payments[$rowOrder->username])) {
                        array_push($payments[$rowOrder->username], $rowOrder->payment);
                    }
                }

                if (empty($orderIds) || !in_array($rowOrder->order_id, $orderIds)) {
                    array_push($orderIds, $rowOrder->order_id);

                    $priceRate = $resultExchange['to_rate'] > 0 ? $rowOrder->price * $resultExchange['to_rate'] : $rowOrder->price;

                    // Merge array trades
                    if (!isset($trades[$rowOrder->type])) {
                        $trades[$rowOrder->type] = [];

                        array_push($trades[$rowOrder->type], [
                            'advertiser' => $rowOrder->username,
                            'limit_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'min_amount' => number_format($rowOrder->min_amount, 8).' '.$rowOrder->symbol,
                            'balance_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'price' => number_format($priceRate, 2).' '.$resultExchange['code'],
                        ]);
                    } else {
                        array_push($trades[$rowOrder->type], [
                            'advertiser' => $rowOrder->username,
                            'limit_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'min_amount' => number_format($rowOrder->min_amount, 8).' '.$rowOrder->symbol,
                            'balance_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'price' => number_format($priceRate, 2).' '.$resultExchange['code'],
                        ]);
                    }
                }
            }
        }

        // Merge payments to trades
        foreach ($trades as &$tradeType) {
            foreach ($tradeType as &$trade) {
                $advertiser = $trade['advertiser'];
                if (isset($payments[$advertiser])) {
                    $trade['payments'] = $payments[$advertiser];
                }
            }
        }

        return [
            'symbol'  => $symbol,
            'trades' => $trades,
        ];
    }

    public function setFormatOrderByUser($username, $orderDetails, $resultExchange)
    {
        $orderIds   = [];
        $trades     = [];
        $payments   = [];
        $username   = $username;

        foreach ($orderDetails as $rowOrder) {
            if (in_array($rowOrder->status, StatusName::ORDER_STATUSES)) {
                if (empty($payments) || !in_array($rowOrder->payment, $payments)) {
                    array_push($payments, $rowOrder->payment);
                }

                if (empty($orderIds) || !in_array($rowOrder->order_id, $orderIds)) {
                    array_push($orderIds, $rowOrder->order_id);

                    if (!isset($trades[$rowOrder->symbol])) {
                        $trades[$rowOrder->symbol] = [];
                    }

                    $priceRate = $resultExchange['to_rate'] > 0 ? $rowOrder->price * $resultExchange['to_rate'] : $rowOrder->price;

                    // Merge array trades
                    if (!isset($trades[$rowOrder->symbol][$rowOrder->type])) {
                        $trades[$rowOrder->symbol][$rowOrder->type] = [];

                        array_push($trades[$rowOrder->symbol][$rowOrder->type], [
                            'limit_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'min_amount' => number_format($rowOrder->min_amount, 8).' '.$rowOrder->symbol,
                            'balance_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'price' => number_format($priceRate, 2).' '.$resultExchange['code'],
                            'status'    => $rowOrder->status,
                        ]);
                    } else {
                        array_push($trades[$rowOrder->symbol][$rowOrder->type], [
                            'limit_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'min_amount' => number_format($rowOrder->min_amount, 8).' '.$rowOrder->symbol,
                            'balance_amount' => number_format($rowOrder->limit_amount, 8).' '.$rowOrder->symbol,
                            'price' => number_format($priceRate, 2).' '.$resultExchange['code'],
                            'status'    => $rowOrder->status,
                        ]);
                    }
                }
            }
        }

        // Merge payments to trades
        foreach ($trades as &$tradeSymbol) {
            foreach ($tradeSymbol as &$tradeType) {
                foreach ($tradeType as &$trade) {
                    $trade['payments'] = $payments;
                }
            }
        }

        return [
            'advertiser'  => $username,
            'trades' => $trades,
        ];
    }
}
