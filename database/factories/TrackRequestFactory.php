<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrackRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_type' => function(){
                $types =array("create"=>"create", "update"=>"update", "delete"=> "delete");
                return array_rand($types);
            },
            'status' => 1,
            'user_id' => 1,
            'request_data' => 'admin',
            'creator_id' => 1,
        ];
    }
}





