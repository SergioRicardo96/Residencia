<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //
        User::create([
            'name' => 'Sergio Ricardo',
            'email' => 'narutoremolinoo96@gmail.com',
            'password' => bcrypt('12345678'),
            'rol' => 'admin',

        ]);

        factory(User::class, 50)->create();
    }
}
