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
            'id' => 'f6654b11-8f04-4ac9-993f-116a8a6ecaae',
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
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Awaiting Payment',
            'description' => 'Customer has completed the checkout process, but payment has yet to be confirmed. Authorize only transactions that are not yet captured have this status.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Awaiting Fulfillment',
            'description' => 'Customer has completed the checkout process and payment has been confirmed.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Awaiting Shipment',
            'description' => 'Order has been pulled and packaged and is awaiting collection from a shipping provider.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Awaiting Pickup',
            'description' => 'Order has been packaged and is awaiting customer pickup from a seller-specified location.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Partially Shipped',
            'description' => 'Only some items in the order have been shipped, due to some products being pre-order only or other reasons.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Completed',
            'description' => 'Order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product, and their file(s) are available for download.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Shipped',
            'description' => 'Order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. A listing of all orders with a "Shipped" status can be found under the More tab of the View Orders screen.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Cancelled',
            'description' => 'Seller has cancelled an order, due to a stock inconsistency or other reasons. Stock levels will automatically update depending on your Inventory Settings. Cancelling an order will not refund the order. This status is triggered automatically when an order using an authorize-only payment gateway is voided in the control panel before capturing payment.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Declined',
            'description' => 'Seller has marked the order as declined for lack of manual payment, or other reasons.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Refunded',
            'description' => 'Seller has used the Refund action. A listing of all orders with a "Refunded" status can be found under the More tab of the View Orders screen.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Disputed',
            'description' => 'Customer has initiated a dispute resolution process for the PayPal transaction that paid for the order.',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
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
            'id' => '402c447e-939f-41b3-bf4b-82a3faecc3db',
            'name' => 'Deleted',
            'description' => 'Deleted record',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);



        // Image or album status
        DB::table('statuses')->insert([
            'id' => 'cad5abf4-ed94-4184-8f7a-fe5084fb7d56',
            'name' => 'Preview',
            'description' => 'Preview album or image',
            'status_type_id' => '12a49330-14a5-41d2-b62d-87cdf8b252f8',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '389842b7-a010-40c1-85cf-4f5b5144ccea',
            'name' => 'Hidden',
            'description' => 'Hidden album or image',
            'status_type_id' => '12a49330-14a5-41d2-b62d-87cdf8b252f8',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'be8843ac-07ab-4373-83d9-0a3e02cd4ff5',
            'name' => 'Published',
            'description' => 'Published album or image',
            'status_type_id' => '12a49330-14a5-41d2-b62d-87cdf8b252f8',
            'user_id' => 1,
        ]);



    }
}
