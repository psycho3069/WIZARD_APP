<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('admin123'),
                'remember_token' => NULL,
                'created_at' => '2022-07-29 04:45:27',
                'updated_at' => '2022-07-29 04:45:27',
                'type' => 'admin',
                'db_name' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'sub admin',
                'email' => 'sub_admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('admin123'),
                'remember_token' => NULL,
                'created_at' => '2022-07-29 04:46:31',
                'updated_at' => '2022-07-29 04:46:31',
                'type' => 'sub_admin',
                'db_name' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('11112222'),
                'remember_token' => NULL,
                'created_at' => '2022-07-29 04:46:31',
                'updated_at' => '2022-07-29 04:46:31',
                'type' => 'customer',
                'db_name' => NULL,
            ),
        ));


    }
}
