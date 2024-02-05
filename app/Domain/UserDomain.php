<?php

namespace App\Domain;

class UserDomain
{
    public function setFormatUserWallet($userDetail)
    {
        $username   = '';
        $email  = '';
        $role   = '';
        $wallet = [];
        foreach ($userDetail as $rowUser) {
            if (empty($username) && empty($email) && empty($role) && empty($wallet)) {
                $username   = $rowUser->username;
                $email  = $rowUser->email;
                $role   = $rowUser->role;
                array_push($wallet, [
                    'symbol'    => $rowUser->symbol,
                    'balance'   => $rowUser->balance,
                    'address'   => $rowUser->address,
                ]);
            }else {
                array_push($wallet, [
                    'symbol'    => $rowUser->symbol,
                    'balance'   => $rowUser->balance,
                    'address'   => $rowUser->address,
                ]);
            }
        }

        return [
            'username'  => $username,
            'email' => $email,
            'role'  => $role,
            'wallet'    => $wallet,
        ];
    }
}
