<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::insert([
            [
                'login' => 'admin',
                'email' => 'admin@guestbook.com',
                'url' => 'https://ua.linkedin.com/in/gurdzhiian'
            ]
        ]);
    }
}
