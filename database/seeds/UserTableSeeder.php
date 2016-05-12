<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //  Client::truncate();
      factory(User::class,10)->create();
      // factory(\CodeProject\Entities\User::class)->create([
      //   'name' => 'admin',
      //   'email' => 'admin@email.com',
      //   'password' => bcrypt(123456),
      //   'remember_token' => str_random(10),
      // ]);
    }
}
