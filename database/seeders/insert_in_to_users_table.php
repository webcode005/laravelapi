<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class insert_in_to_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  [
            [
              'name' => 'Super Admin',
              'email' => 'superadmin@gmail.com',
              'password' =>bcrypt('123456'),
            ],
            [
              'name' => 'Account Admin',
              'email' => 'accountadmin@gmail.com',
              'password' =>bcrypt('13456'),
            ],
            [
              'name' => 'Project Admin',
              'email' => 'projectadmin@gmail.com',
              'password' =>bcrypt('13456'),
            ],
            [
              'name' => 'Client Admin',
              'email' => 'clientadmin@gmail.com',
              'password' =>bcrypt('13456'),
            ]
          ];

          User::insert($users);
    }
}
