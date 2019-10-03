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
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //

        DB::table('status_types')->insert([
            'id' => 'e4f89909-2398-45f3-8809-56a0bb82d2d4',
            'name' => 'Record',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // active, inactive, deleted

        DB::table('status_types')->insert([
            'id' => '45385a87-2402-4cb9-9d56-ec946cf35b72',
            'name' => 'Product',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // out of stock,

        DB::table('status_types')->insert([
            'id' => '4491a8d8-3fd8-45d5-8ffb-8948a1d78b9a',
            'name' => 'Inventory',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // back order, in stock, low stock

        DB::table('status_types')->insert([
            'id' => '511b013b-aa8a-4e5b-a681-1b85f938ef2b',
            'name' => 'Order',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // https://support.bigcommerce.com/s/article/Order-Statuses
        // Pending, awaiting payment,awaiting shipment, partially shipped, completed, shipped, cancelled, declined, refunded, disputed, partially refunded
    }
}
