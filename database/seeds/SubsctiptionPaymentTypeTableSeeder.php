<?php

use Illuminate\Database\Seeder;

class SubsctiptionPaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('subscription_payment_types')->insert([
            'id' => '7dd05c3c-7526-498b-9fbb-d0c766a678ac',
            'name' => 'MPESA',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

        DB::table('subscription_payment_types')->insert([
            'id' => 'a2e58e16-6578-4ca1-8058-b12a347fdc69',
            'name' => 'Paypal',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

        DB::table('subscription_payment_types')->insert([
            'id' => 'ee2ab071-a0ad-4367-b6a0-e42fc5c57aa1',
            'name' => 'Card',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

    }
}
