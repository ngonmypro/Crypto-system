<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Wallet;
use App\Domain\UserDomain;
use Illuminate\Http\Request;
use App\Libraries\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function getUserList()
    {
       $results = User::getUserList();

       return JsonResponse::messageResponse("Get User List Completed", 200, $results);
    }

    public function createUser(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username'  => 'required|string|unique:tbl_users',
                'email'     => 'required|string|email|unique:tbl_users',
                'password'  => 'required|string|min:6'
            ]);

            if ($validate->fails()){
                return JsonResponse::messageResponse($validate->errors()->messages(), 400);
            }
            DB::beginTransaction();
            $resultUserDetail = User::createUser($request->all());
            $resultWalletDetail = Wallet::createDefaultWalletNewUser((object) $resultUserDetail);

            DB::commit();
            return JsonResponse::messageResponse("Create New User Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }

    public function getWalletByUser($username)
    {
        $resultUser = User::getWalletByUser($username);
        $result = UserDomain::setFormatUserWallet($resultUser);

        return JsonResponse::messageResponse("Get User Completed", 200, $result);
    }
}
