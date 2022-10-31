<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'aungpor.napat@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "aungpor";
            $user->role = 'ADMIN';
            $user->email = 'aungpor.napat@gmail.com';
            $user->password = Hash::make('aungpor1');
            $user->save();
        }

        $user = User::where('email', 'ployputita@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "ploy";
            $user->role = 'ADMIN';
            $user->email = 'ployputita@gmail.com';
            $user->password = Hash::make('ployputita');
            $user->save();
        }

        $user = User::where('email', 'student.affair@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Rose";
            $user->role = 'STUDENTAFFAIR';
            $user->email = 'student.affair@gmail.com';
            $user->password = Hash::make('student.affair');
            $user->save();
        }

        $user = User::where('email', 'staff@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Beauty";
            $user->role = 'STAFF';
            $user->email = 'staff@gmail.com';
            $user->password = Hash::make('staffpass');
            $user->save();
        }

        $user = User::where('email', 'manager@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Peter";
            $user->role = 'MANAGER';
            $user->email = 'manager@gmail.com';
            $user->password = Hash::make('managerpass');
            $user->save();
        }

        $user = User::where('email', 'user01@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Mute";
            $user->role = 'USER';
            $user->email = 'user01@gmail.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        $user = User::where('email', 'user02@gmail.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Smart";
            $user->role = 'USER';
            $user->email = 'user02@gmail.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        User::factory(5)->create();
    }
}
