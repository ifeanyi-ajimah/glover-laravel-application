<?php

namespace App\Utils;
use Illuminate\Support\Facades\Auth;
use App\Utils\AppJsonResponse;

class RequestActionPermission{

    public static function checkUser($creator_id)
    {
        if( Auth::id() == $creator_id){
            return AppJsonResponse::failureResponse(
                403 , "Forbiden. Action not allowed"
           );
        }
    }
}

