<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Utils\UserType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 10;
        $password = bcrypt('password');

    for($i =0; $i <= $numberOfUsers; $i++ ){
        
        $userEmail = ucfirst($this->faker->email);
        $createdDate = $this->faker->boolean ? now() : now()->subDays($this->faker->numberBetween(0, 180));
        $updateDate = $this->faker->boolean ? now() : now()->subDays($this->faker->numberBetween(0, 180));

        User::updateOrCreate([
            'email' => $userEmail,
        ],
        [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $userEmail,
            'type' => function(){
                $types = UserType::All_USER_TYPE;
                return array_rand($types);
            },
            'password' => $password,
            'created_at' => $createdDate,
            'updated_at' => $updateDate,
        ]);
    }
    }
}




