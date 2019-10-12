<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'id' => '0839e6c9-20b3-4442-b3b6-5137a4d309ec',
            'name' => 'Ksh',
            'description' => 'Kenyan Shillings',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
