<?php

use Illuminate\Database\Seeder;

class SalutationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salutation')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Sir',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('salutation')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'Madam',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('salutation')->insert([
            'id' => '07c99d10-8e09-4861-83df-fdd3700d7e48',
            'name' => 'Mr',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('salutation')->insert([
            'id' => 'eb170451-f926-4980-aa9a-604a8f49d3af',
            'name' => 'Mrs',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('salutation')->insert([
            'id' => '2c042e3f-f3d8-4dca-9e55-a539d77b0d27',
            'name' => 'Miss',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('salutation')->insert([
            'id' => '38a357d4-c4bc-4777-a133-8062fc7a854a',
            'name' => 'Dr',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
