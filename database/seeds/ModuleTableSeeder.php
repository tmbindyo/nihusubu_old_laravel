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
            'description' => 'A point of sale system, or POS, is the place where your customer makes a payment for products or services at your store. Simply put, every time a customer makes a purchase at your store, they\'re completing a point of sale transaction.',
            'price' => 570.00,
            'daily_price' => 19.00,
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
            'description' => 'To Do is a task management app to help you stay organized and manage your day-to-day, keeps track of all your tasks, projects, and goals in one beautifully simple place.',
            'price' => 0.00,
            'daily_price' => 0.00,
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
            'description' => 'Settings is an area on the device that gives you access to all preferences of the business account.',
            'price' => 0.00,
            'daily_price' => 0.00,
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
            'description' => 'Budgeting is the process of creating a plan to spend your money. This spending plan is called a budget. Creating this spending plan allows you to determine in advance whether you will have enough money to do the things you need to do or would like to do. Budgeting is simply balancing your expenses with your income.',
            'price' => 0.00,
            'daily_price' => 0.00,
            'is_business' => false,
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
            'description' => 'A Chama is an informal cooperative society that is normally used to pool and invest savings by people in East Africa, and particularly Kenya. This module enables you to manage the working sof your chama.',
            'price' => 120.00,
            'daily_price' => 4.00,
            'is_business' => false,
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
            'description' => 'Accounting is the process of recording financial transactions pertaining to a business. The accounting process includes summarizing, analyzing, and reporting these transactions to oversight agencies, regulators, and tax collection entities.',
            'price' => 150.00,
            'daily_price' => 5.00,
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
            'description' => 'Customer Relationship Management (CRM) is a strategy that companies use to manage interactions with customers and potential customers. CRM helps organisations streamline processes, build customer relationships, increase sales, improve customer service, and increase profitability.',
            'price' => 120.00,
            'daily_price' => 4.00,
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
            'description' => 'Everything You Need To Start Selling Online Today. Accept Credit Cards. Mobile Commerce Ready. Fulfillment Integration. Full Blogging Platform. SEO Optimized. Social Media Integration. Secure Shopping Cart. Drop Shipping Integration.',
            'price' => 510.00,
            'daily_price' => 17.00,
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
            'description' => 'Sales is a term used to describe the activities that lead to the selling of goods or services.',
            'price' => 300.00,
            'daily_price' => 10.00,
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
            'description' => 'This module enables you to manage the products and services that your business offers.',
            'price' => 0.00,
            'daily_price' => 0.00,
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
            'description' => 'Inventory management refers to the process of ordering, storing, and using a company\'s inventory. These include the management of raw materials, components, and finished products, as well as warehousing and processing such items.',
            'price' => 360.00,
            'daily_price' => 12.00,
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
