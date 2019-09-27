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
            'name' => 'Thomas Mbindyo',
            'email' => 'tmbindyo@nihusubu.com',
            'phone_number' => '+254708085128',
            'email_verified_at' => now(),
            'password' => Hash::make('WaveNDCUsEZonEbE'),
            'user_type_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'info',
            'email' => 'info@nihusubu.com',
            'phone_number' => '+254708085128',
            'email_verified_at' => now(),
            'password' => Hash::make('RoBANdoREfeRNiaN'),
            'user_type_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Elizabeth Ndunge',
            'email' => 'endunge@nihusubu.com',
            'phone_number' => '+254740338642',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
