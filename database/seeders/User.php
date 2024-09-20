<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Customer();
        $user->name = 'User2';
        $user->username = 'User2';
        $user->email = 'User2@gmail.com';
        $user->password= Hash::make('12345');
        $user->phone = '12345678912';
        $user->status = 'enable';
        $user->role_id = 1;
        $user->save();
    }
}
