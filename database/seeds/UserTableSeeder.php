<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'info',
            'email' => 'info@nihusubu.com',
            'phone_number' => '+254708085122',
            'email_verified_at' => now(),
            'password' => Hash::make('RoBANdoREfeRNiaN'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Fluidtech Global',
            'email' => 'info@fluidtechglobal.com',
            'phone_number' => '+254708085121',
            'email_verified_at' => now(),
            'password' => Hash::make('WaveNDCUsEZonEbE'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Thomas Mbindyo',
            'email' => 'tmbindyo@fluidtechglobal.com',
            'phone_number' => '+254740338642',
            'email_verified_at' => now(),
            'password' => Hash::make('rSubSouStORtIcti'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
