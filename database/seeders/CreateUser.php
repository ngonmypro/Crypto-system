<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username'  => 'nguan_admin',
                'email'     => 'psomyimproduct@gmail.com',
                'password'  => '1qazZAQ!',
                'role'      =>  1
            ],
            [
                'username'  => 'nguan_seller',
                'email'     => 'aa@gmail.com',
                'password'  => '1qazZAQ!',
                'role'      =>  2
            ],
            [
                'username'  => 'nguan_buyer',
                'email'     => 'bb@gmail.com',
                'password'  => '1qazZAQ!',
                'role'      =>  2
            ],
        ];

        foreach ($data as $value) {
            User::create([
                'username'  => $value['username'],
                'email'     => $value['email'],
                'password'  => Hash::make($value['password']),
                'role'      => $value['role'],
            ]);
        }
    }
}
