<?php

use Illuminate\Database\Seeder;

class AccountTypeTableSeeder extends Seeder
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
            'id' => '163fa506-9762-422a-a981-cce20b21f1ad',
            'name' => 'Bills, Utilities',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '8c0c1829-b6cf-4d38-b640-755db25460ae',
            'name' => 'Cash, Transfers',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '17401c1e-1423-40bc-846a-008b0e72373c',
            'name' => 'Fees, Government Payments',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '008315c2-ee90-4e55-80cc-de2a8bc0472a',
            'name' => 'Food, Dining',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => 'af7b5592-8c36-4746-b369-a3985c90fd0b',
            'name' => 'Health, Personal Care',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '1c523f60-ab8f-4dd7-88ca-a70863507a3b',
            'name' => 'Home and Living',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '6943fd67-ba09-4fc3-986a-3550ae959b33',
            'name' => 'Income',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '84ccf3c6-74fb-4af9-b4b2-7bef9d0469b8',
            'name' => 'Kids, Family',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '55faadc5-6275-4d19-809e-dc56e555929f',
            'name' => 'Leisure, Entertainment',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '6269dc50-cfc9-4b3f-8c91-a1adc6bb998e',
            'name' => 'Loans',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => 'c7c1a0a0-8775-45a7-a84b-92a8dac302d3',
            'name' => 'No Category',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '83569f71-59dc-46f0-a92f-fdac4ad922aa',
            'name' => 'Shopping',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '7b05bf74-08e0-4692-becd-799b11d24dba',
            'name' => 'Transport',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'is_institution' => false,
            'is_user' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('account_types')->insert([
            'id' => '46089cb5-ef46-4d9f-af5c-9676d7a55ed4',
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
