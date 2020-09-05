<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'created_at' => now()
        ]);


        DB::table('users')->insert([
            'name' => 'Fluidtech Global',
            'email' => 'info@fluidtechglobal.com',
            'phone_number' => '+254708085121',
            'email_verified_at' => now(),
            'password' => Hash::make('WaveNDCUsEZonEbE'),
            'created_at' => now()
        ]);


        DB::table('users')->insert([
            'name' => 'Thomas Mbindyo',
            'email' => 'tmbindyo@fluidtechglobal.com',
            'phone_number' => '+254740338642',
            'email_verified_at' => now(),
            'password' => Hash::make('rSubSouStORtIcti'),
            'created_at' => now()
        ]);
        // get user
        $AddedUser = User::findOrFail(2);
        // get role
        $role = Role::findOrFail(1);
        $AddedUser->assignRole($role->id);


        DB::table('users')->insert([
            'name' => 'Rohni Randiek',
            'email' => 'rrandiek@fluidtechglobal.com',
            'phone_number' => '+254739896558‬',
            'email_verified_at' => now(),
            'password' => Hash::make('rSubSouStORtIcti'),
            'created_at' => now()
        ]);
        // get user
        $AddedUser = User::findOrFail(3);
        // get role
        $role = Role::findOrFail(1);
        $AddedUser->assignRole($role->id);

        DB::table('user_accounts')->insert([
            'id' => '7dd05c3c-7526-498b-9fbb-d0c766a678ac',
            'user_id' => '3',
            'user_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'registerer_id' => '1',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'is_institution' => false,
            'is_active' => true,
            'is_user' => false,
            'is_admin' => true,
            'created_at' => now()
        ]);


    }
}
