<?php

use Illuminate\Database\Seeder;

class ReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reasons')->insert([
            'id' => '6a31fab4-30d2-49c8-9797-a641a3b99c58',
            'name' => 'Stock on fire',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => 'fe7a91c4-b338-4342-a683-e3be6a282302',
            'name' => 'Stolen Goods',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => '0ddf50d3-1fb8-4253-9aba-947e79508220',
            'name' => 'Damaged Goods',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => '3a71470d-1b60-43b8-b8a8-c1e4e9c56a1b',
            'name' => 'Stock written off',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => '6743d5e2-615d-4c24-a512-b6936f67e1ef',
            'name' => 'Stocktaking results',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => '1e2ba19b-134e-48d6-a249-e522247681db',
            'name' => 'Inventory Reevaluation',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reasons')->insert([
            'id' => 'afbab3e4-6884-4b51-a393-81bef0ba2b67',
            'name' => 'Transfer Order',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
