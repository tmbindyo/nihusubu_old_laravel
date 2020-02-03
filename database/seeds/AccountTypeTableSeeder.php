<?php

use Illuminate\Database\Seeder;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        // Cost of goods sold accounts
        DB::table('account_types')->insert([
            'id' => 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5',
            'name' => 'Cost Of Goods Sold',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 3,
            'is_institution' => true,
            'is_user' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Expense expense accounts
        DB::table('account_types')->insert([
            'id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
            'name' => 'Expense',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => true,
            'is_user' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Income accounts
        DB::table('account_types')->insert([
            'id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
            'name' => 'Income',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => true,
            'is_user' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Stock accounts
        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Stock',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => true,
            'is_user' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);





        // Bills and Utilities
        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Bills, Utilities',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Cash, Transfers',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Fees, Government Payments',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Food, Dining',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Health, Personal Care ',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Home and Living',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Income',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Kids, Family',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Leisure, Entertainment',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Loans',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'No Category',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Shopping',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Transport',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Wealth Creation',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
