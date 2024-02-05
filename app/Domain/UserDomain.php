<?php

namespace App\Domain;

class UserDomain
{
    public function setFormatUserWallet($userDetail)
    {
        $username   = '';
        $email  = '';
        $role   = '';
        $wallets = [];
        foreach ($userDetail as $rowUser) {
            if (empty($username) && empty($email) && empty($role) && empty($wallets)) {
                $username   = $rowUser->username;
                $email  = $rowUser->email;
                $role   = $rowUser->role;
                array_push($wallets, [
                    'symbol'    => $rowUser->symbol,
                    'balance'   => number_format($rowUser->balance, 8).' '.$rowUser->symbol,
                    'address'   => $rowUser->address,
                ]);
            }else {
                array_push($wallets, [
                    'symbol'    => $rowUser->symbol,
                    'balance'   => number_format($rowUser->balance, 8).' '.$rowUser->symbol,
                    'address'   => $rowUser->address,
                ]);
            }
        }

        return [
            'username'  => $username,
            'email'     => $email,
            'role'      => $role,
            'wallet'    => $wallets,
        ];
    }
}
