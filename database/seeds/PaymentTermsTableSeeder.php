<?php

use Illuminate\Database\Seeder;

class PaymentTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_terms')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 15',
            'number_of_days' => '15',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'a715c4e8-ef95-4d45-9281-fe4c3012d6c1',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 30',
            'number_of_days' => '30',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '52352f2d-8b28-4a5b-931f-505f555969ae',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 45',
            'number_of_days' => '45',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '19f37e3d-0a46-4a1b-bb68-2653dec26acb',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 60',
            'number_of_days' => '60',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'fa7c6566-941a-46e0-b30f-bd5bc31b9c72',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Month',
            'number_of_days' => '0',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'b69363d4-2dfd-41f8-8329-92518b11ff02',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Next Month',
            'number_of_days' => '0',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '54f8d94b-afc6-4c99-b4a1-6a2560a3ef46',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due On Receipt',
            'number_of_days' => '0',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
