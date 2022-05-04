<?php 

namespace App\Utils;
use App\Utils\RequestStatus;
use App\Utils\AppJsonResponse;

class CheckAvailability{

    public static function checkRequestAvailability($reqdata, $status)
    {
        if( !count($reqdata) || $status == RequestStatus::Inactive){
            return AppJsonResponse::failureResponse(
                401 , "This request has been attended to or does not exist"
           );

        }
    }
}

