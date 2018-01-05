<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'tk',
            'email' => 'tk@div-art.com',
            'password' => bcrypt('111111111')
        ]);
    }
}
