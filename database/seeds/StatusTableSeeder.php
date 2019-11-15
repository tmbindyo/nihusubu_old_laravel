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
            'name' => 'Available',
            'description' => 'Available',
            'label' => 'label-primary',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '969a6f67-576d-4506-af9c-75247851a0db',
            'name' => 'Unavailable',
            'description' => 'Unavailable',
            'label' => 'label-warning',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '87c53b05-903f-4bb7-b7d8-4ff205077fdc',
            'name' => 'Out Of Stock',
            'description' => 'Out Of Stock with no customer orders pending',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '5a104a8a-62c1-4f56-bd89-9faf14c2fef2',
            'name' => 'Back Order',
            'description' => 'A product that is temporarily out of stock with the supplier with pending customer orders.',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'bc6170bf-299a-44f5-8362-8cdeed1f47b0',
            'name' => 'Discontinued',
            'description' => 'For one reason or the other, the product is no longer being sold.',
            'label' => 'label-default',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);


        // Estimate statuses
        DB::table('statuses')->insert([
            'id' => '14efab17-4306-449b-bfc8-3e156b872a6d',
            'name' => 'Draft',
            'description' => 'Estimates that are In Review, allow you to make edits and tweaks before submitting it to a potential client.',
            'label' => 'label-warning',
            'status_type_id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '3033d8f4-88e0-4ca9-9ed1-62e0b9c61547',
            'name' => 'Submitted',
            'description' => 'An estimate that has been submitted to a client.',
            'label' => 'label-',
            'status_type_id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '3c5de19a-bbeb-4342-9acd-d4f8dcbdb58f',
            'name' => 'Approved',
            'description' => 'An estimate that has been approved by a client.',
            'label' => 'label-',
            'status_type_id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '0f6c8ddf-9447-4663-b0c1-c772bf407ac5',
            'name' => 'Declined',
            'description' => 'An estimate that has been rejected by a client and the conversation is closed.',
            'label' => 'label-',
            'status_type_id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '11d8aaeb-169e-41ba-b550-e1d24f07dbe3',
            'name' => 'In Review',
            'description' => 'An estimate that has been rejected by a client, but under review.',
            'label' => 'label-',
            'status_type_id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'user_id' => 1,
        ]);


        // Order
        DB::table('statuses')->insert([
            'id' => 'a6c4c2cc-95ca-4ecf-8ce3-3d08512aad15',
            'name' => 'Pending',
            'description' => 'Customer started the checkout process but did not complete it. Incomplete orders are assigned a "Pending" status and can be found under the More tab in the View Orders screen.',
            'label' => '',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '662fe669-1975-4dc2-89aa-640a44f62562',
            'name' => 'Awaiting Payment',
            'description' => 'Customer has completed the checkout process, but payment has yet to be confirmed. Authorize only transactions that are not yet captured have this status.',
            'label' => 'label-primary',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'ad5bc18f-2828-4c3f-83f7-3003b63c5e60',
            'name' => 'Awaiting Fulfillment',
            'description' => 'Customer has completed the checkout process and payment has been confirmed.',
            'label' => 'label-warning',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '352ba9f7-1335-4062-bbea-2415e73760cd',
            'name' => 'Awaiting Shipment',
            'description' => 'Order has been pulled and packaged and is awaiting collection from a shipping provider.',
            'label' => 'label-warning',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '4f3e7238-383d-4ce6-a51c-bf61f8a900e5',
            'name' => 'Awaiting Pickup',
            'description' => 'Order has been packaged and is awaiting customer pickup from a seller-specified location.',
            'label' => 'label-warning',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '5089aa1d-8a20-4a4c-a381-7020f2ae0fb7',
            'name' => 'Partially Shipped',
            'description' => 'Only some items in the order have been shipped, due to some products being pre-order only or other reasons.',
            'label' => 'label-information',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'fbb297a2-3650-4c6e-9de1-717331764e76',
            'name' => 'Completed',
            'description' => 'Order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product, and their file(s) are available for download.',
            'label' => 'label-information',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '8207f496-7010-4705-9b5f-ba638461b236',
            'name' => 'Shipped',
            'description' => 'Order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. A listing of all orders with a "Shipped" status can be found under the More tab of the View Orders screen.',
            'label' => 'label-success',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '400b6002-6585-440c-9cd3-fa4418cb6ad0',
            'name' => 'Cancelled',
            'description' => 'Seller has cancelled an order, due to a stock inconsistency or other reasons. Stock levels will automatically update depending on your Inventory Settings. Cancelling an order will not refund the order. This status is triggered automatically when an order using an authorize-only payment gateway is voided in the control panel before capturing payment.',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '9de38571-ae64-4642-a2ca-d3ed8dcf9566',
            'name' => 'Declined',
            'description' => 'Seller has marked the order as declined for lack of manual payment, or other reasons.',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'c57ff54a-61c8-41ad-b35e-2fb5328564f6',
            'name' => 'Refunded',
            'description' => 'Seller has used the Refund action. A listing of all orders with a "Refunded" status can be found under the More tab of the View Orders screen.',
            'label' => 'label-warning',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '4a02cf4c-0dc1-4e43-96d6-b777af0306db',
            'name' => 'Disputed',
            'description' => 'Customer has initiated a dispute resolution process for the PayPal transaction that paid for the order.',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'b71cf167-bb67-45c1-86a5-2e850d003abe',
            'name' => 'Partially Refunded',
            'description' => 'Seller has partially refunded the order.',
            'label' => 'label-danger',
            'status_type_id' => 'e6dc4713-612f-455e-a30c-3e29ebdddf70',
            'user_id' => 1,
        ]);



        // Record status
        DB::table('statuses')->insert([
            'id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'name' => 'Active',
            'description' => 'Active record',
            'label' => 'label-primary',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '402c447e-939f-41b3-bf4b-82a3faecc3db',
            'name' => 'Inactive',
            'description' => 'Inactive record',
            'label' => 'label-warning',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'd35b4cee-5594-4cfd-ad85-e489c9dcdeff',
            'name' => 'Deleted',
            'description' => 'Deleted record',
            'label' => 'label-danger',
            'status_type_id' => 'a558001b-69ae-4872-ba0f-ecadd154a70a',
            'user_id' => 1,
        ]);




        // Client statuses
        DB::table('statuses')->insert([
            'id' => '4a6fe484-12df-4ba7-8a74-7c95b9e553cd',
            'name' => 'Active',
            'description' => 'Active client',
            'label' => 'label-primary',
            'status_type_id' => '3a1df270-df7a-41af-b1f6-a778d9dbde3d',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'c33b4155-f100-4cb3-8547-297db18d8205',
            'name' => 'Pending',
            'description' => 'Pending client',
            'label' => 'label-warning',
            'status_type_id' => '3a1df270-df7a-41af-b1f6-a778d9dbde3d',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => 'e2de216c-8976-49aa-8176-3d1c7d79cb2f',
            'name' => 'Phoned',
            'description' => 'Phoned client',
            'label' => 'label-info',
            'status_type_id' => '3a1df270-df7a-41af-b1f6-a778d9dbde3d',
            'user_id' => 1,
        ]);
        DB::table('statuses')->insert([
            'id' => '33a893be-9862-4b07-b063-c9ba4e48daa4',
            'name' => 'Deleted',
            'description' => 'Deleted client',
            'label' => 'label-danger',
            'status_type_id' => '3a1df270-df7a-41af-b1f6-a778d9dbde3d',
            'user_id' => 1,
        ]);



    }
}
