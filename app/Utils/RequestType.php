<?php 

namespace App\Utils;

final class RequestType {
    public const Create = 'create';
    public const Update = 'update';
    public const Delete = 'delete';
    
    public const All_USER_TYPE = [
        self::Create,
        self::Update,
        self::Delete,
    ];

}