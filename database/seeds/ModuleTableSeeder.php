<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // module

        DB::table('modules')->insert([
            'id' => '47b313f1-2324-4231-a25e-dd31c057daef',
            'name' => 'POS',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);



        DB::table('modules')->insert([
            'id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182',
            'name' => 'To Do',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b',
            'name' => 'Settings',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '2e22600b-f8fb-493a-8de8-ba33d279e882',
            'name' => 'Budgeting',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '33c5f6c2-fe9a-4b32-843b-d243d8dae58a',
            'name' => 'Chama',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => false,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7',
            'name' => 'Accounting',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca',
            'name' => 'CRM',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '1e19eb1c-e299-4e2e-a22b-fb97a4b066a5',
            'name' => 'Ecommerce',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '9acedca8-5320-4b4e-b088-ec44467344a0',
            'name' => 'Sales',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3',
            'name' => 'Product Management',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


        DB::table('modules')->insert([
            'id' => '2d89966e-c6f2-4967-b278-f65df98448db',
            'name' => 'Inventory Management',
            'price' => 0.00,
            'is_business' => true,
            'is_user' => true,
            'is_admin' => false,
            'is_paid' => true,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);


    }
}
