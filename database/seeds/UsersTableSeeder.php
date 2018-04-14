<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(
            [
                'name' => 'Joel Rosenthal',
                'email' => 'joel.rosenthal@gmail.com',
                'password' => bcrypt('password'),
                'remember_token' => 'IgK45nyBmzct08Cm3FzURKsnAkliTi5f62jwuqYdp6KuamNzIOL6Kk2redib',
            ]
        );
    }
}
