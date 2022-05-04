<?php 

namespace App\Utils;

final class RequestType {
    
    public const Store = 'store';
    public const Update = 'update';
    public const Delete = 'delete';
    
    public const All_USER_TYPE = [
        self::Store,
        self::Update,
        self::Delete,
    ];

}