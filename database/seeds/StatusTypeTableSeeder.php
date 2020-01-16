<?php

use Illuminate\Database\Seeder;

class StatusTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_types')->insert([
            'id' => 'aa4faace-6b6f-48c4-9af8-84767f449f7b',
            'name' => 'To Do',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => 'e4f89909-2398-45f3-8809-56a0bb82d2d4',
            'name' => 'Record',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // active, inactive, deleted

        DB::table('status_types')->insert([
            'id' => '45385a87-2402-4cb9-9d56-ec946cf35b72',
            'name' => 'Product',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // out of stock,

        DB::table('status_types')->insert([
            'id' => '4491a8d8-3fd8-45d5-8ffb-8948a1d78b9a',
            'name' => 'Inventory',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // back order, in stock, low stock

        DB::table('status_types')->insert([
            'id' => '63d0ab87-de50-43e1-849b-8349b0671225',
            'name' => 'Estiamte',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('status_types')->insert([
            'id' => '511b013b-aa8a-4e5b-a681-1b85f938ef2b',
            'name' => 'Order',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // https://support.bigcommerce.com/s/article/Order-Statuses
        // Pending, awaiting payment,awaiting shipment, partially shipped, completed, shipped, cancelled, declined, refunded, disputed, partially refunded

        DB::table('status_types')->insert([
            'id' => '3a1df270-df7a-41af-b1f6-a778d9dbde3d',
            'name' => 'Client',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('status_types')->insert([
            'id' => '3b3fd271-2a21-44b8-9246-f90793639f24',
            'name' => 'Payment',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('status_types')->insert([
            'id' => 'a3909a25-635a-4adf-a5dc-651c9c08becb',
            'name' => 'Email Subscription',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('status_types')->insert([
            'id' => 'a3909a25-adfa-4635-a5dc-651c9c08becb',
            'name' => 'Contact Us Status',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
