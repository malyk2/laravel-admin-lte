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
        $user = User::firstOrNew([
            'name' => 'tk',
            'email' => 'tk@div-art.com',
        ]);
        $user->password = bcrypt('111111111');
        $user->save();
    }
}
