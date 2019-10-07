<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // to do statuses
        DB::table('statuses')->insert([
            'id' => 'f3df38e3-c854-4a06-be26-43dff410a3bc',
            'name' => 'Pending',
            'description' => 'Pending',
            'status_type_id' => '1a252cab-df69-44f4-8cea-1d9d9e388a99',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '2a2d7a53-0abd-4624-b7a1-a123bfe6e568',
            'name' => 'In progress',
            'description' => 'In progress',
            'status_type_id' => '1a252cab-df69-44f4-8cea-1d9d9e388a99',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => 'facb3c47-1e2c-46e9-9709-ca479cc6e77f',
            'name' => 'Completed',
            'description' => 'Completed',
            'status_type_id' => '1a252cab-df69-44f4-8cea-1d9d9e388a99',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '99372fdc-9ca0-4bca-b483-3a6c95a73782',
            'name' => 'Overdue',
            'description' => 'Overdue',
            'status_type_id' => '1a252cab-df69-44f4-8cea-1d9d9e388a99',
            'user_id' => 1,
        ]);




        // Product status
        DB::table('statuses')->insert([
            'id' => 'f6654b11-8f04-4ac9-993f-116a8a6ecaae',
            'name' => 'Unavailable',
            'description' => 'Unavailable',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '5a104a8a-62c1-4f56-bd89-9faf14c2fef2',
            'name' => 'Back Order',
            'description' => 'A product that is temporarily out of stock with the supplier.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);


        // Order
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Pending',
            'description' => 'Customer started the checkout process but did not complete it. Incomplete orders are assigned a "Pending" status and can be found under the More tab in the View Orders screen.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '662fe669-1975-4dc2-89aa-640a44f62562',
            'name' => 'Awaiting Payment',
            'description' => 'Customer has completed the checkout process, but payment has yet to be confirmed. Authorize only transactions that are not yet captured have this status.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => 'ad5bc18f-2828-4c3f-83f7-3003b63c5e60',
            'name' => 'Awaiting Fulfillment',
            'description' => 'Customer has completed the checkout process and payment has been confirmed.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '352ba9f7-1335-4062-bbea-2415e73760cd',
            'name' => 'Awaiting Shipment',
            'description' => 'Order has been pulled and packaged and is awaiting collection from a shipping provider.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '4f3e7238-383d-4ce6-a51c-bf61f8a900e5',
            'name' => 'Awaiting Pickup',
            'description' => 'Order has been packaged and is awaiting customer pickup from a seller-specified location.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '5089aa1d-8a20-4a4c-a381-7020f2ae0fb7',
            'name' => 'Partially Shipped',
            'description' => 'Only some items in the order have been shipped, due to some products being pre-order only or other reasons.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => 'fbb297a2-3650-4c6e-9de1-717331764e76',
            'name' => 'Completed',
            'description' => 'Order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product, and their file(s) are available for download.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '8207f496-7010-4705-9b5f-ba638461b236',
            'name' => 'Shipped',
            'description' => 'Order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. A listing of all orders with a "Shipped" status can be found under the More tab of the View Orders screen.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '400b6002-6585-440c-9cd3-fa4418cb6ad0',
            'name' => 'Cancelled',
            'description' => 'Seller has cancelled an order, due to a stock inconsistency or other reasons. Stock levels will automatically update depending on your Inventory Settings. Cancelling an order will not refund the order. This status is triggered automatically when an order using an authorize-only payment gateway is voided in the control panel before capturing payment.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '9de38571-ae64-4642-a2ca-d3ed8dcf9566',
            'name' => 'Declined',
            'description' => 'Seller has marked the order as declined for lack of manual payment, or other reasons.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => 'c57ff54a-61c8-41ad-b35e-2fb5328564f6',
            'name' => 'Refunded',
            'description' => 'Seller has used the Refund action. A listing of all orders with a "Refunded" status can be found under the More tab of the View Orders screen.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);

        DB::table('statuses')->insert([
            'id' => '4a02cf4c-0dc1-4e43-96d6-b777af0306db',
            'name' => 'Disputed',
            'description' => 'Customer has initiated a dispute resolution process for the PayPal transaction that paid for the order.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'b71cf167-bb67-45c1-86a5-2e850d003abe',
            'name' => 'Partially Refunded',
            'description' => 'Seller has partially refunded the order.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);



        // Record status
        DB::table('statuses')->insert([
            'id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'name' => 'Active',
            'description' => 'Active record',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '402c447e-939f-41b3-bf4b-82a3faecc3db',
            'name' => 'Inactive',
            'description' => 'Inactive record',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff',
            'name' => 'Deleted',
            'description' => 'Deleted record',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);



    }
}
