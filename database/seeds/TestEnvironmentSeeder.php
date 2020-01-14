<?php

use Illuminate\Database\Seeder;

class TestEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Units
        DB::table('units')->insert([
            'id' => 'ee731ec9-2d3a-4f5b-a58f-c67c6b591855',
            'name' => 'ML',
            'description' => 'Millilitres',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => '049c14ed-5ab2-46b6-898f-d4011f7ae450',
            'name' => 'Litre',
            'description' => 'Litres',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => 'aca0bd83-d861-4f7b-932f-28f412836e0e',
            'name' => 'Dozen',
            'description' => '12 items in product',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('units')->insert([
            'id' => 'de63c87d-98cb-4c5b-b40a-a16fcbd01853',
            'name' => 'KG',
            'description' => 'Kilograms',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Taxes
        DB::table('taxes')->insert([
            'id' => '661e9884-37d4-4401-a408-ce5fac44a022',
            'name' => 'VAT',
            'amount' => '16',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'is_percentage' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('taxes')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'name' => 'Catering Levy',
            'amount' => '6',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'is_percentage' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('warehouses')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'name' => 'Test',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'address_id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',
            'user_id' => 1,
            'is_primary' => True,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('addresses')->insert([
            'id' => '1c8f7aa4-e983-426b-8b71-2584795a0c63',

            'email' => 'warehouse@nihusubu.com',
            'phone_number' => '0708085128',
            'town' => 'Nairobi',
            'po_box' => '73919',
            'postal_code' => '00100',
            'address_line_1' => 'General Accident Houses, 2nd Floor',
            'address_line_2' => 'Woodley',
            'street' => 'Ralph Bunche Road',

            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'address_type_id' => 'f7e388be-1eaa-4acc-9929-daf50bb0b5d1',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);




        DB::table('payment_terms')->insert([
            'id' => '953af05b-8bae-4d71-a0d0-0a83cffa9366',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 15',
            'number_of_days' => '15',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'e6cfeee5-42cd-4a4d-afed-6d117f61ca4a',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 30',
            'number_of_days' => '30',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '08edaea3-39be-49f1-9ce7-ccd1c91ea493',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 45',
            'number_of_days' => '45',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'a0fecc93-877e-4f04-a1e0-f2af7d960172',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Net 60',
            'number_of_days' => '60',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '41e5bd3e-6a90-4759-976f-f8f5a00d7c28',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Month',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => 'b3bf096e-0f21-474e-9e1d-3b0566dd3e6e',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due End Of Next Month',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('payment_terms')->insert([
            'id' => '7f59d7eb-fdb4-480f-ae07-b1e74fe1af37',
            'institution_id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'name' => 'Due On Receipt',
            'number_of_days' => '0',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);



        // Title
        DB::table('titles')->insert([
            'id' => '7c3d68ed-354c-4d66-b881-7725626c03f4',
            'name' => 'Mr',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('titles')->insert([
            'id' => '4621ba42-0832-47de-869f-da5775d2bc52',
            'name' => 'Mrs',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('titles')->insert([
            'id' => 'e0807ac4-8f8c-40c4-b05c-3ca9171100bb',
            'name' => 'Ms',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('titles')->insert([
            'id' => 'c70fd8c4-4f22-4997-ad82-3e77901acf0c',
            'name' => 'Dr',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('titles')->insert([
            'id' => 'f3164c3d-96c9-43a3-86da-5757df810100',
            'name' => 'Prof',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);




        // Lead source
        DB::table('lead_sources')->insert([
            'id' => '7c3d68ed-354c-4d66-b881-7725626c03f4',
            'name' => 'Advertisment',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => '4621ba42-0832-47de-869f-da5775d2bc52',
            'name' => 'Chat',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => 'e0807ac4-8f8c-40c4-b05c-3ca9171100bb',
            'name' => 'Cold Call',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => 'c70fd8c4-4f22-4997-ad82-3e77901acf0c',
            'name' => 'Client Referral',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => 'f3164c3d-96c9-43a3-86da-5757df810100',
            'name' => 'Contact Referral',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => '42f59dbd-042c-4aee-bb91-8aa8ce962df5',
            'name' => 'Employee Referral',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => 'f86cdba2-e537-4fcf-92ab-f17f1edabcb7',
            'name' => 'Other',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => '55197824-2ca1-4ff1-8835-f15762e8bd07',
            'name' => 'Public Relations',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);
        DB::table('lead_sources')->insert([
            'id' => '94201006-ad8b-4841-96a1-5f23e0eeb3d9',
            'name' => 'Website',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);




        // Frequency
        DB::table('frequencies')->insert([
            'id' => '3aa43370-2877-46c3-b6f4-1c0b6aef92f6',
            'name' => 'Daily',
            'type' => 'day',
            'frequency' => '1',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '11bde94f-e686-488e-9051-bc52f37df8cf',
            'name' => 'Weekly',
            'type' => 'week',
            'frequency' => '1',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '488bb73e-d5a3-4e4c-9dda-25f207f27c4c',
            'name' => 'Bi Weekly',
            'type' => 'week',
            'frequency' => '2',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '6c401203-b697-43f0-9c4d-b5a58e93f861',
            'name' => 'Monthly',
            'type' => 'month',
            'frequency' => '1',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '300fbbee-9c14-4b54-82cb-7076abfc345b',
            'name' => 'Quarterly',
            'type' => 'month',
            'frequency' => '3',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '02940587-ff97-47d9-8fa9-06c94827bd5b',
            'name' => 'Semiannually',
            'type' => 'month',
            'frequency' => '6',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => '37e1bdf-37c1-4962-81fe-1186fab4b456',
            'name' => 'Annually',
            'type' => 'year',
            'frequency' => '1',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('frequencies')->insert([
            'id' => 'de217726-8544-442b-a767-b20fdb570527',
            'name' => 'Bi Annually',
            'type' => 'year',
            'frequency' => '2',
            'user_id' => 1,
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);



        // Campaign types
        DB::table('campaign_types')->insert([
            'id' => '7c3d68ed-354c-4d66-b881-7725626c03f4',
            'name' => 'Sell',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '2efa2729-6438-4397-b06d-ecded822cec3',
            'name' => 'Conference',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => 'c31c3b47-4353-4916-bfc1-d38e54c49024',
            'name' => 'Webniar',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '56f4db2f-e685-4307-99c9-52a0640fd4eb',
            'name' => 'Trade Show',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '23c139e8-4c04-423f-9e9b-04e8921f61c1',
            'name' => 'Public Relations',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '383ff37f-9fee-42ad-981f-baacc3a41338',
            'name' => 'Partners',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '89135570-7baa-4ae8-bce5-1df1a06d589e',
            'name' => 'Referral Program',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '186ce466-b837-4975-a8ef-f1117720cb40',
            'name' => 'Advertisment',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '2e81a235-0421-4008-b0aa-4ceaf4e0d2b9',
            'name' => 'Banner Ad',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => '895fdf34-adca-482e-a20b-87d73139e0ca',
            'name' => 'Email',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => 'b7e7b954-8b66-4b0e-9c85-e7045faa2c49',
            'name' => 'Telemarketing',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('campaign_types')->insert([
            'id' => 'd2f9c962-2af0-4566-bd54-d92fdafa8a3b',
            'name' => 'Other',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);



        // Contact types
        DB::table('contact_types')->insert([
            'id' => '6fdf4858-01ce-43ff-bbe6-827f09fa1cef',
            'name' => 'Client',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('contact_types')->insert([
            'id' => 'ca64a5e0-d39b-4f2c-a136-9c523d935ea4',
            'name' => 'Partner',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);

        DB::table('contact_types')->insert([
            'id' => 'a5ac460c-9a97-4b89-99f4-3592c0a9387f',
            'name' => 'Supplier',
            'user_id' => 1,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'institution_id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
        ]);


    }
}
