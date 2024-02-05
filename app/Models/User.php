<?php

namespace App\Models;

use DB;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table 		= 	'tbl_users';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function user_payment_type()
    {
        return $this->hasMany(User_Payment_Type::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function getUserList()
    {
        return User::select('*', self::convertRole())->get();
    }

    private function convertRole()
    {
        return  DB::raw('CASE
                    WHEN tbl_users.role = 1 THEN "ADMIN"
                    WHEN tbl_users.role = 2 THEN "USER"
                    ELSE "ROLE NOT SUPPORT"
                END AS role'
                );
    }
    public function createUser($request)
    {
        $result =   User::create([
                        'username'  => $request['username'],
                        'email'     => $request['email'],
                        'password'  => Hash::make($request['password']),
                        'role'      => 2,
                    ]);

        return  [
                    'username'  => $result->username,
                    'lastId'    => $result->id
                ];
    }

    public function getWalletByUser($username)
    {
        return  User::select(
                    'tbl_users.username',
                    'tbl_users.email',
                    self::convertRole(),
                    'tbl_cryptocurrencies.symbol',
                    'tbl_wallet.balance',
                    'tbl_wallet.address',
                )
                ->join('tbl_wallet', 'tbl_users.id', '=', 'tbl_wallet.user_id')
                ->join('tbl_cryptocurrencies', 'tbl_wallet.crypto_id', '=', 'tbl_cryptocurrencies.id')
                ->where('tbl_users.username', $username)
                ->get();
    }

    public function getUserAndWalletByUsername($username, $cryptoId)
    {
        return  User::select(
                    'tbl_users.id',
                    'tbl_wallet.id AS wallet_id',
                    'tbl_wallet.address',
                    'tbl_wallet.balance',
                )
                ->join('tbl_wallet', 'tbl_users.id', '=', 'tbl_wallet.user_id')
                ->where([
                    'tbl_users.username'    => $username,
                    'tbl_wallet.crypto_id'  => $cryptoId
                ])
                ->first();
    }
}
