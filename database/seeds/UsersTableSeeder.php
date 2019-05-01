<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'User User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Investor Investor',
            'email' => 'investor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Ella Martinez',
            'email' => 'projectmanager@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type_id' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
