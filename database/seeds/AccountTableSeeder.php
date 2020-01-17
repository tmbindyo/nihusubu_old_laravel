<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {


        // accounts

        DB::table('accounts')->insert([
            'id' => 'ee1e792a-db44-4a11-859e-f6cd08b370e3',
            'reference' => 'zxspM',
            'name' => 'NCBA Account',
            'balance' => 0,
            'goal' => 2000000,
            'notes' => 'NCBA business account',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('accounts')->insert([
            'id' => 'cae524a1-6738-4873-923a-f599fb93f4af',
            'reference' => '1jqvG',
            'name' => 'Petty Cash',
            'balance' => 0,
            'goal' => 20000,
            'notes' => 'Physical cash always kept',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('accounts')->insert([
            'id' => 'e2bc3dbd-b04e-4430-945a-0e1e08f56ed1',
            'reference' => 'ZPmgY',
            'name' => 'Paypal',
            'balance' => 0,
            'goal' => 0,
            'notes' => 'Payments made to paypal',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('accounts')->insert([
            'id' => '881514cf-fc5e-448b-9dbc-94a997246367',
            'reference' => 'zixco',
            'name' => 'MPESA',
            'balance' => 0,
            'goal' => 0,
            'notes' => 'MPESA balance, shared with my safaricom line.',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now()
        ]);


        // Cost of goods sold accounts
        DB::table('account_types')->insert([
            'id' => 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5',
            'name' => 'Cost Of Goods Sold',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
            DB::table('expense_accounts')->insert([
                'id' => '992fc533-b325-44b5-b2fd-de15ca8b2209',
                'name' => 'Cost Of Goods Sold',
                'code' => 'COGS',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'ee1f1b2d-9485-4d03-993a-e27d5ee210f5',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        // Expense expense accounts
        DB::table('account_types')->insert([
            'id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
            'name' => 'Expense',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // todo get descriptions
            DB::table('expense_accounts')->insert([
                'id' => '3664bd74-6680-4951-af57-3412d520e895',
                'name' => 'Advertising and Marketing',
                'code' => 'A&M',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'd4d0aa9b-4d7d-4a5b-a08b-70620a3b4f65',
                'name' => 'Automobile Expense',
                'code' => 'AE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '1092751f-e8a0-4333-a299-60448badbacd',
                'name' => 'Bad Debt',
                'code' => 'BD',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'f55210fc-08f2-4f98-9570-9cb3785050d7',
                'name' => 'Bank Fees and Charges',
                'code' => 'BF&C',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '0e003daf-d79d-45cc-a2fc-883248ce87b3',
                'name' => 'Consultant Expense',
                'code' => 'CE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'd73d7c8c-60d8-4130-b677-fbac9715702a',
                'name' => 'Credit Card Charges',
                'code' => 'CCC',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '4e722702-d811-4415-9a06-32333146ae6c',
                'name' => 'Depreciation Expense',
                'code' => 'DE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '13cef891-f45e-4796-ab0f-e4783fe9b121',
                'name' => 'IT and Internet Expenses',
                'code' => 'IT&IE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'cf0aa095-318a-4327-ba08-aac0ef17e158',
                'name' => 'Janitorial Expense',
                'code' => 'JE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '893d738a-e67b-4fbf-bdf9-39115ad28027',
                'name' => 'Lodging',
                'code' => 'L',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '96982b67-7904-4c0b-bc9b-7d17e599f4a2',
                'name' => 'Meals and Entertainment',
                'code' => 'M&E',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'b1eeadc4-0ef1-46e3-8c37-3ab3edeb0073',
                'name' => 'Office Supplies',
                'code' => 'OS',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'f5b2aae3-4c80-492b-9a90-091fe170341d',
                'name' => 'Other Expenses',
                'code' => 'OE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'b54e977d-adc9-4c45-968b-899781fb5ae8',
                'name' => 'Parking',
                'code' => 'Pa',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '2044d6b4-681b-40f0-a246-3714e1743525',
                'name' => 'Postage',
                'code' => 'Po',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '4be74ac0-5468-4b0f-9dbf-26401908b542',
                'name' => 'Printing and Stationery',
                'code' => 'P&S',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '843e9644-412d-4c48-b422-4a9b60b83835',
                'name' => 'Printing and Stationery',
                'code' => 'P&S',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '5c7554a8-9ccf-4531-8352-03dd1f2f2227',
                'name' => 'Rent Expense',
                'code' => 'RE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'dd7f309a-2977-4f62-bb5b-03d4744c6772',
                'name' => 'Repairs and Maintenance',
                'code' => 'R&M',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '7969a4b1-6822-40de-815f-f743e24e8c54',
                'name' => 'Salaries and Employee Wages',
                'code' => 'S&EW',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'bfa41b87-85ff-43f4-ad6a-e2736a9f802b',
                'name' => 'Telephone Expenses',
                'code' => 'TeE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '7af6d4a1-5000-452a-9d92-172b59021a90',
                'name' => 'Travel Expense',
                'code' => 'TrE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '060ca285-9b41-409c-9353-d983b161e7aa',
                'name' => 'Uncategorized',
                'code' => 'UE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => 'b3e71a37-eb71-4ebc-b448-e4f9daf6bbcd',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);


        // Income accounts
        DB::table('account_types')->insert([
            'id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
            'name' => 'Income',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
            DB::table('expense_accounts')->insert([
                'id' => '4011f0a6-e620-411b-b6ff-62e2a08e7b55',
                'name' => 'Discount',
                'code' => 'D',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'ee607ffc-d94e-428a-958c-b5bafdc27c45',
                'name' => 'General Income',
                'code' => 'GE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '3398d588-f09c-4574-9591-967206b58600',
                'name' => 'Interest Income',
                'code' => 'IE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '0687c3de-37a3-47eb-851c-4366d693b64f',
                'name' => 'Late Fee Income',
                'code' => 'LFE',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'ee1e792a-db44-4a11-859e-f6cd08b370e3',
                'name' => 'Other Charges',
                'code' => 'OC',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'cae524a1-6738-4873-923a-f599fb93f4af',
                'name' => 'Sales',
                'code' => 'S',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '42454ea5-20ea-4fec-aea4-38f6b6a87c74',
                'name' => 'Shipping Charge',
                'code' => 'SC',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '798077ba-ae21-4df0-8079-5a7c82afd90e',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        // Stock accounts
        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Stock',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
            DB::table('expense_accounts')->insert([
                'id' => '474273a4-b266-4767-9036-a572498619c2',
                'name' => 'Finished Goods',
                'code' => 'FG',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'e5206406-79bc-4e32-94c0-1032949d38a8',
                'name' => 'Finished Goods',
                'code' => 'FG',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => '3644f5c-7ede-4101-a522-232f47eea579',
                'name' => 'Inventory Asset',
                'code' => 'IA',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('expense_accounts')->insert([
                'id' => 'e91917c1-989f-4429-8bf6-98c088c2e0a1',
                'name' => 'Work In Progress',
                'code' => 'WIP',
                'description' => 'Account to track the Cost Of Goods Sold',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'account_type_id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
                'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);

    }
}
