<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'id' => '4a02a718-bade-4344-9d0b-4a036dbf1486',
            'name' => 'Admin',
            'description' => 'Nihusubu administrator account',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('user_types')->insert([
            'id' => '95761ea3-c5a2-453f-bcc0-f19d70b4851f',
            'name' => 'User',
            'description' => 'Nihusubu user account',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
