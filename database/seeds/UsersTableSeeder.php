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
        DB::table('users')->insert([
            'id' => 1,
            'firstName' => 'Admin',
            'lastName' => 'Doe',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('123456')
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'firstName' => 'Observer',
            'lastName' => 'Doe',
            'email' => 'observer@mail.com',
            'role' => 'observer',
            'password' => bcrypt('123456')
        ]);
    }
}
