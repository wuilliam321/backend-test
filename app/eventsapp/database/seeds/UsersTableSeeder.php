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
        \App\User::insert([
            'name' => 'Wuilliam',
            'email' => 'wuilliam321@gmail.com',
            'password' => bcrypt('123321'),
        ]);
    }
}
