<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'    => 'test@admin.com',
            'password' => '123456',
            'name'     => 'Test Admin',
            'is_admin' => true
        ]);

        User::create([
            'email'    => 'test@user.com',
            'password' => '123456',
            'name'     => 'Test User',
            'is_admin' => false
        ]);
    }
}
