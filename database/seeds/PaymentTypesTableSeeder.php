<?php

use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 15',
            'number_of_days' => '15',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
