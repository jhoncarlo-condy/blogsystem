<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'firstname' => 'Jhon Carlo',
           'lastname' => 'Condy',
           'email' => 'jhoncarlo.condy@gmail.com',
           'password' => Hash::make('secret'),
            'usertype' => '1'
        ]);
    }
}
