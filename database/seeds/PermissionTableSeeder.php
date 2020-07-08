<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = Permission::create(['name' => 'add to do','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $permission = Permission::create(['name' => 'view to do','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);
        $permission = Permission::create(['name' => 'view to dos','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);

        // calendar
        $permission = Permission::create(['name' => 'view calendar','module_id' => '99f59a14-1e3b-4b54-a33d-29cbb5431182']);

        // product groups
        $permission = Permission::create(['name' => 'add product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view product groups','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'edit product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'delete product group','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);

        // products
        $permission = Permission::create(['name' => 'add product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view products','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'edit product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'delete product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);

        // composite products
        $permission = Permission::create(['name' => 'add composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'view composite products','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'edit composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);
        $permission = Permission::create(['name' => 'delete composite product','module_id' => 'b018d16c-4ef2-44dc-9c5e-be8e7d896bf3']);

        // stock
        $permission = Permission::create(['name' => 'view stock','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view restock','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);

        // inventory adjustments
        $permission = Permission::create(['name' => 'add inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view inventory adjustments','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'edit inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'delete inventory adjustment','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);

        // transfer orders
        $permission = Permission::create(['name' => 'add transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view transfer orders','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'edit transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'delete transfer order','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);

        // warehouses
        $permission = Permission::create(['name' => 'add warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'view warehouses','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'edit warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);
        $permission = Permission::create(['name' => 'delete warehouse','module_id' => '2d89966e-c6f2-4967-b278-f65df98448db']);

        // campaign
        $permission = Permission::create(['name' => 'add campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view campaigns','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'edit campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'delete campaign','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'add campaign uploads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view campaign uploads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);

        // contacts
        $permission = Permission::create(['name' => 'add contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view contacts','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'edit contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'delete contact','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);

        // leads
        $permission = Permission::create(['name' => 'add lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view leads','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'edit lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'delete lead','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);

        // organizations
        $permission = Permission::create(['name' => 'add organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'view organizations','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'edit organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);
        $permission = Permission::create(['name' => 'delete organization','module_id' => '406cdcdc-d1c0-4a57-b7fc-18a1fa20aaca']);

        // estimates
        $permission = Permission::create(['name' => 'add estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view estimates','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'print estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'convert to invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'edit estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'delete estimate','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);

        // invoices
        $permission = Permission::create(['name' => 'add invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view invoices','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'print invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'convert to sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'edit invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'delete invoice','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);

        // sales
        $permission = Permission::create(['name' => 'add sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'view sales','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'print sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'add sale payment','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'edit sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);
        $permission = Permission::create(['name' => 'delete sale','module_id' => '9acedca8-5320-4b4e-b088-ec44467344a0']);

        // accounts
        $permission = Permission::create(['name' => 'add account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view accounts','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete account','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // account adjustments
        $permission = Permission::create(['name' => 'add account adjustment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view account adjustments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // withdrawals
        $permission = Permission::create(['name' => 'add withdrawal','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view withdrawal','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view withdrawals','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // deposits
        $permission = Permission::create(['name' => 'add deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view deposits','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit deposit','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // expenses
        $permission = Permission::create(['name' => 'add expenses','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view expenses','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete expense','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // expense payments
        $permission = Permission::create(['name' => 'add expense payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view expense payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view expense payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // loans
        $permission = Permission::create(['name' => 'add loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view loans','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'add loan payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete loan','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // payments
        $permission = Permission::create(['name' => 'add payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view pending payments','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete payment','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // refunds
        $permission = Permission::create(['name' => 'add refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view refunds','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete refund','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // transfers
        $permission = Permission::create(['name' => 'add transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'view transfers','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'edit transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);
        $permission = Permission::create(['name' => 'delete transfer','module_id' => '803a3317-6f4c-4ba7-aa2f-60ff01477be7']);

        // campaign types
        $permission = Permission::create(['name' => 'add campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view campaign types', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete campaign type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // contact types
        $permission = Permission::create(['name' => 'add contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view contact types', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete contact type', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // frequency
        $permission = Permission::create(['name' => 'add frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view frequencies', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete frequency', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // lead sources
        $permission = Permission::create(['name' => 'add lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view lead sources', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete lead source', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // taxes
        $permission = Permission::create(['name' => 'add tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view taxes', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete tax', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // titles
        $permission = Permission::create(['name' => 'add title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view titles', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete title', 'module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // units
        $permission = Permission::create(['name' => 'add unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view units','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete unit','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);


        // roles
        $permission = Permission::create(['name' => 'add role','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view role','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view roles','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'revoke role permission','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit role','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete role','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);

        // roles
        $permission = Permission::create(['name' => 'add user','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view user','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'view users','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'edit user','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);
        $permission = Permission::create(['name' => 'delete user','module_id' => 'eaa241d4-0834-4ec3-80b1-e8e416cc324b']);



    }
}
