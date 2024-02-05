<?php
namespace App\Libraries;

class JsonResponse {
    public static function messageResponse($msg, $code = 200,$data = array(), $format="", $merge_data = false)
    {

        $status     =   0;
        if($code==200)  $status     =   1;

        if(empty($msg))
        {
            switch($code)
            {
                case 200:
                    $msg        =   "Success";
                break;
                case 400:
                    $msg        =   "Bad Request !";
                break;
                case 401:
                    $msg        =   "Validate Fail !";
                break;
                case 402:
                    $msg        =   "Upload Fail !";
                break;
                case 403:
                    $msg        =   "Unauthorized";
                break;
                case 404:
                    $msg        =   "Data Not Found !";
                break;
                case 409:
                    $msg        =   "Conflict !";
                break;
                case 500:
                    $msg        =   "Internal Server Error !";
                break;
            }
        }else{
            $msg_list = [];
            if (gettype($msg) == "array") {
                foreach ($msg as $key => $text) {
                    $msg    =   $text[0];
                    break;
                }
            }
        }

        $apiObj     =   array(  "success" => $status,
                                "code" => $code,
                                "message"   =>  $msg);
        if($merge_data){
            $apiObj = array_merge($apiObj, $data);
        }else{
            if(!empty($data) && empty($format))  $apiObj["data"] = $data;

            if (!empty($format)) $apiObj[$format] = $data;
        }


        return response()->json($apiObj , $code);

    }
}
