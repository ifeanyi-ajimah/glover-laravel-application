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
            'request_data' => [
                'id'         => 1,
                'first_name' => $this->faker->name,
                'last_name'  => $this->faker->name,
                'email'      => $this->faker->name,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ],
            'creator_id' => 1,
        ];
    }
}





