<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\User::class)->times(50)->make();
        \App\User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = \App\User::find(1);
        $user->name = 'alex';
        $user->email = 'alex@qq.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
