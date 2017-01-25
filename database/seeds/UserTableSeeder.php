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
        factory(\CodeDelivery\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]));

        factory(\CodeDelivery\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]));

        factory(\CodeDelivery\Models\User::class,10)->create()->each(function($u){
            $u->client()->save(factory(\CodeDelivery\Models\Client::class)->make());
        });

    }
}
