<?php

use Illuminate\Database\Seeder;

use App\Event;
use App\Guest;
use App\Product;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Eloquent::unguard();

        $this->call(UsersTableSeeder::class);
    }
}
