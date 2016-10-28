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
        User::create(
            [
                'username' => 'admin',
                'firstname' => 'Ovidijus',
                'lastname' => 'Kaminskas',
                'email' => 'ovidijus.kaminskas1@gmail.com',
                'role_id' => 4,
                'password' => bcrypt('115678'),
            ]
        );
    }
}
