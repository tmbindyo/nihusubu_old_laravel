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
        DB::table('account_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Billing',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
