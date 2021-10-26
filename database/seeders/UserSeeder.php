<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = new User;
        $user->first_name = 'ADMIN';
        $user->last_name = 'MIC';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('123456789');
        $user->institut='uca';
        $user->type_profile='admin';
        $user->save();
    }
}
