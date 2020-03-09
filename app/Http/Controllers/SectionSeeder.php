<?php

namespace App\Http\Controllers;

use App\Section;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class SectionSeeder extends Controller
{



    //
    public function sectionSeeder()
    {



        $data = [
            [
                'name' => 'Dashboard',
                'description' => 'Dashboard',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Calendar',
                'description' => 'Calendar',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'To Do',
                'description' => 'To Do',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Product',
                'description' => 'Product',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Inventory',
                'description' => 'Inventory',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'CRM',
                'description' => 'CRM',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Sales',
                'description' => 'Sales',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Accounting',
                'description' => 'Accounting',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Settings',
                'description' => 'Settings',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],

            [
                'name' => 'Feedback',
                'description' => 'Feedback',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => True,
                'user_id' => 1,
            ],




            [
                'name' => 'Dashboard',
                'description' => 'Dashboard',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Calendar',
                'description' => 'Calendar',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'To Do',
                'description' => 'To Do',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Contacts',
                'description' => 'Contacts',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Buddgeting',
                'description' => 'Buddgeting',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Chamas',
                'description' => 'Chamas',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Accounting',
                'description' => 'Accounting',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ],

            [
                'name' => 'Settings',
                'description' => 'Settings',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'is_business' => False,
                'user_id' => 1,
            ]

        ];


        foreach ($data as $entry) {
            Section::create(
                $entry
            );
        }
        $section = Section::all();

    }

    public function MenuSeeder(){

        // dashboard
        $dashboardSection = Section::where('name','Dashboard')->where('is_business',True)->first();
        $sectionData = [
            [
                'name' => 'Dashboard',
                'description' => 'Dashboard',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.dashboard',
                'section_id' => $dashboardSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }


        // calendar
        $calendarSection = Section::where('name','Calendar')->where('is_business',True)->first();
        $sectionData = [
            [
                'name' => 'Dashboard',
                'description' => 'Dashboard',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.calendar',
                'section_id' => $calendarSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }

        // to do
        $toDoSection = Section::where('name','To Do')->where('is_business',True)->first();
        $sectionData = [
            [
                'name' => 'toDos',
                'description' => 'To Dos',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.dos',
                'section_id' => $toDoSection->id,
            ],
            [
                'name' => 'toDoStore',
                'description' => 'To Do Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.do.store',
                'section_id' => $toDoSection->id,
            ],
            [
                'name' => 'toDoUpdate',
                'description' => 'To Do Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.do.update',
                'section_id' => $toDoSection->id,
            ],
            [
                'name' => 'toDoSetInProgress',
                'description' => 'To Do Set In Progress',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.do.set.in.progress',
                'section_id' => $toDoSection->id,
            ],
            [
                'name' => 'toDoSetCompleted',
                'description' => 'To Do Set Completed',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.do.set.completed',
                'section_id' => $toDoSection->id,
            ],
            [
                'name' => 'toDoDelete',
                'description' => 'To Do Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.to.do.delete',
                'section_id' => $toDoSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }

        // product
        $productSection = Section::where('name','Product')->where('is_business',True)->first();
        $sectionData = [
            // product group
            [
                'name' => 'productGroups',
                'description' => 'Product Groups',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.groups',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupCreate',
                'description' => 'Product Group Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.create',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupStore',
                'description' => 'Product Group Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.store',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupShow',
                'description' => 'Product Group Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.show',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupEdit',
                'description' => 'Product Group Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.edit',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupUpdate',
                'description' => 'Product Group Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.update',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupDelete',
                'description' => 'Product Group Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.delete',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productGroupRestore',
                'description' => 'Product Group Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.group.restore',
                'section_id' => $productSection->id,
            ],

            // products
            [
                'name' => 'products',
                'description' => 'Products',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.products',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productCreate',
                'description' => 'Product Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.create',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productStore',
                'description' => 'Product Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.store',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productShow',
                'description' => 'Product Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.show',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productEdit',
                'description' => 'Product Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.edit',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productUpdate',
                'description' => 'Product Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.update',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productDelete',
                'description' => 'Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.delete',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productRestore',
                'description' => 'Product Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.restore',
                'section_id' => $productSection->id,
            ],
            // product image
            [
                'name' => 'productImageUpload',
                'description' => 'Product Image Upload',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.image.upload',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productImageDelete',
                'description' => 'Product Image Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.image.delete',
                'section_id' => $productSection->id,
            ],
            // product discount
            [
                'name' => 'productDiscountStore',
                'description' => 'Product Discount Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.discount.store',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productDiscountUpdate',
                'description' => 'Product Discount Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.discount.update',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'productDiscountDelete',
                'description' => 'Product Discount Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.product.discount.delete',
                'section_id' => $productSection->id,
            ],

            // composite products
            [
                'name' => 'compositeProducts',
                'description' => 'Composite Products',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.products',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductCreate',
                'description' => 'Composite Product Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.create',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductStore',
                'description' => 'Composite Product Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.store',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductShow',
                'description' => 'Composite Product Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.show',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductEdit',
                'description' => 'Composite Product Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.edit',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductUpdate',
                'description' => 'Composite Product Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.update',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductDelete',
                'description' => 'Composite Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.delete',
                'section_id' => $productSection->id,
            ],
            [
                'name' => 'compositeProductRestore',
                'description' => 'Composite Product Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.composite.product.restore',
                'section_id' => $productSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }

        // inventory adjustments
        $inventorySection = Section::where('name','Inventory')->where('is_business',True)->first();
        $sectionData = [
            // inventory adjustments
            [
                'name' => 'inventoryAdjustments',
                'description' => 'Inventory Adjustments',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustments',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentCreate',
                'description' => 'Inventory Adjustment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.create',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentStore',
                'description' => 'Inventory Adjustment Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.store',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentShow',
                'description' => 'Inventory Adjustment Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.show',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentEdit',
                'description' => 'Inventory Adjustment Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.edit',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentUpdate',
                'description' => 'Inventory Adjustment Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.update',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentDelete',
                'description' => 'Inventory Adjustment Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.delete',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'inventoryAdjustmentRestore',
                'description' => 'Inventory Adjustment Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.inventory.adjustment.restore',
                'section_id' => $inventorySection->id,
            ],
            // transfer order
            [
                'name' => 'transferOrders',
                'description' => 'Transfer Orders',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.orders',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderCreate',
                'description' => 'Transfer Order Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.create',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderStore',
                'description' => 'Transfer Order Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.store',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderShow',
                'description' => 'Transfer Order Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.show',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderEdit',
                'description' => 'Transfer Order Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.edit',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderUpdate',
                'description' => 'Transfer Order Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.update',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderDelete',
                'description' => 'Transfer Order Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.delete',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'transferOrderRestore',
                'description' => 'Transfer Order Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.order.restore',
                'section_id' => $inventorySection->id,
            ],
            // warehouses
            [
                'name' => 'warehouse',
                'description' => 'Warehouses',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouses',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseStore',
                'description' => 'Warehouse Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.store',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseShow',
                'description' => 'Warehouse Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.show',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseEdit',
                'description' => 'Warehouse Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.edit',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseUpdate',
                'description' => 'Warehouse Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.update',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseDelete',
                'description' => 'Warehouse Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.delete',
                'section_id' => $inventorySection->id,
            ],
            [
                'name' => 'warehouseRestore',
                'description' => 'Warehouse Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.warehouse.restore',
                'section_id' => $inventorySection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }


        // crm
        $crmSection = Section::where('name','CRM')->where('is_business',True)->first();
        $sectionData = [
            // campaigns
            [
                'name' => 'campaigns',
                'description' => 'Campaigns',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaigns',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignCreate',
                'description' => 'Campaign Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.create',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignStore',
                'description' => 'Campaign Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.store',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignShow',
                'description' => 'Campaign Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.show',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignUpdate',
                'description' => 'Campaign Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.update',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignDelete',
                'description' => 'Campaign Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.delete',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignRestore',
                'description' => 'Campaign Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.restore',
                'section_id' => $crmSection->id,
            ],
            // campaign contact create
            [
                'name' => 'campaignContactCreate',
                'description' => 'Campaign Contact Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.contact.create',
                'section_id' => $crmSection->id,
            ],
            // campaign deal create
            [
                'name' => 'campaignDealCreate',
                'description' => 'Campaign Deal Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.deal.create',
                'section_id' => $crmSection->id,
            ],
            // campaign expense create
            [
                'name' => 'campaignExpenseCreate',
                'description' => 'Campaign Expense Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.expense.create',
                'section_id' => $crmSection->id,
            ],
            // campaign organization create
            [
                'name' => 'campaignOrganizationCreate',
                'description' => 'Campaign Organization Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.organization.create',
                'section_id' => $crmSection->id,
            ],
            // campaign uploads
            [
                'name' => 'campaignUploads',
                'description' => 'Campaign Uploads',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.uploads',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignUploadStore',
                'description' => 'Campaign Upload Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.upload.store',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'campaignUploadDownload',
                'description' => 'Campaign Upload Download',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.upload.download',
                'section_id' => $crmSection->id,
            ],
            // contacts
            [
                'name' => 'contacts',
                'description' => 'contacts',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contacts',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactCreate',
                'description' => 'Contact Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.create',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactStore',
                'description' => 'Contact Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.store',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactShow',
                'description' => 'Contact Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.show',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactUpdate',
                'description' => 'Contact Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.update',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactDelete',
                'description' => 'Contact Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.delete',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'contactRestore',
                'description' => 'Contact Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.restore',
                'section_id' => $crmSection->id,
            ],
            // contact liability create
            [
                'name' => 'contactLiabilityCreate',
                'description' => 'Contact Liability Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.liability.create',
                'section_id' => $crmSection->id,
            ],
            // contact loan create
            [
                'name' => 'contactLoanCreate',
                'description' => 'Contact Loan Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.loan.create',
                'section_id' => $crmSection->id,
            ],
            // contact sale create
            [
                'name' => 'contactSaleCreate',
                'description' => 'Contact Sale Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.sale.create',
                'section_id' => $crmSection->id,
            ],
            // contact update lead to contact
            [
                'name' => 'contactUpdateLeadToContact',
                'description' => 'Contact Update Lead To Contact',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.update.lead.to.contact',
                'section_id' => $crmSection->id,
            ],
            // leads
            [
                'name' => 'leads',
                'description' => 'Leads',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.leads',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'leadCreate',
                'description' => 'Lead Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.create',
                'section_id' => $crmSection->id,
            ],
            // organizations
            [
                'name' => 'organizations',
                'description' => 'Organizations',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organizations',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationCreate',
                'description' => 'Organization Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.create',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationStore',
                'description' => 'Organization Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.store',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationShow',
                'description' => 'Organization Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.show',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationUpdate',
                'description' => 'Organization Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.show',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationDelete',
                'description' => 'Organization Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.delete',
                'section_id' => $crmSection->id,
            ],
            [
                'name' => 'organizationRestore',
                'description' => 'Organization Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.restore',
                'section_id' => $crmSection->id,
            ],
            // organization contact create
            [
                'name' => 'organizationContactCreate',
                'description' => 'Organization Contact Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.contact.create',
                'section_id' => $crmSection->id,
            ],
            // organization deal create
            [
                'name' => 'organizationDealCreate',
                'description' => 'Organization Deal Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.organization.deal.create',
                'section_id' => $crmSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }


        // sales
        $salesSection = Section::where('name','Sales')->where('is_business',True)->first();
        $sectionData = [
            // sales
            [
                'name' => 'sales',
                'description' => 'Sales',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleCreate',
                'description' => 'Sale Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.create',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleStore',
                'description' => 'Sale Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.store',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleShow',
                'description' => 'Sale Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.show',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'salePrint',
                'description' => 'Sale Print',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.print',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleEdit',
                'description' => 'Sale Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.edit',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleUpdate',
                'description' => 'Sale Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.update',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleDelete',
                'description' => 'Sale Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.delete',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'saleRetore',
                'description' => 'Sale Retore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sales.restore',
                'section_id' => $salesSection->id,
            ],
            // sale payment create
            [
                'name' => 'salePaymentCreate',
                'description' => 'Sale Payment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sale.payment.create',
                'section_id' => $salesSection->id,
            ],
            // sale product delete
            [
                'name' => 'saleProductDelete',
                'description' => 'Sale Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sale.product.delete',
                'section_id' => $salesSection->id,
            ],
            // sale record payment
            [
                'name' => 'saleRecordPayment',
                'description' => 'Sale Record Payment',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sale.record.payment',
                'section_id' => $salesSection->id,
            ],
            // sale record payment refund
            [
                'name' => 'saleRecordPaymentRefund',
                'description' => 'Sale Record Payment Refund',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.sale.record.payment.refund',
                'section_id' => $salesSection->id,
            ],
            // sale record payment refund
            [
                'name' => 'paymentsReceived',
                'description' => 'payments received',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payments.received',
                'section_id' => $salesSection->id,
            ],
            // invoices
            [
                'name' => 'invoices',
                'description' => 'invoices',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoices',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceCreate',
                'description' => 'Invoice Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.create',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceStore',
                'description' => 'Invoice Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.store',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceShow',
                'description' => 'Invoice Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.show',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceEdit',
                'description' => 'Invoice Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.edit',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceUpdate',
                'description' => 'Invoice Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.update',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceDelete',
                'description' => 'Invoice Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.delete',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoiceRestore',
                'description' => 'Invoice Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.restore',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'invoicePrint',
                'description' => 'Invoice Print',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.print',
                'section_id' => $salesSection->id,
            ],
            // invoice convert to sale
            [
                'name' => 'invoiceConvertToSale',
                'description' => 'Invoice Convert To Sale',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.convert.to.sale',
                'section_id' => $salesSection->id,
            ],
            // invoice product delete
            [
                'name' => 'invoiceProductDelete',
                'description' => 'Invoice Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.invoice.product.delete',
                'section_id' => $salesSection->id,
            ],
            // estimates
            [
                'name' => 'estimates',
                'description' => 'estimates',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimates',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateCreate',
                'description' => 'Estimate Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.create',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateStore',
                'description' => 'Estimate Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.store',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateShow',
                'description' => 'Estimate Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.show',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateEdit',
                'description' => 'Estimate Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.edit',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateUpdate',
                'description' => 'Estimate Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.update',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateDelete',
                'description' => 'Estimate Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.delete',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimateRestore',
                'description' => 'Estimate Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.restore',
                'section_id' => $salesSection->id,
            ],
            [
                'name' => 'estimatePrint',
                'description' => 'Estimate Print',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.print',
                'section_id' => $salesSection->id,
            ],
            // estimate convert to sale
            [
                'name' => 'estimateConvertToInvoice',
                'description' => 'Estimate Convert To Invoice',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.convert.to.sale',
                'section_id' => $salesSection->id,
            ],
            // estimate product delete
            [
                'name' => 'estimateProductDelete',
                'description' => 'Estimate Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.estimate.product.delete',
                'section_id' => $salesSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }

        // accounting
        $accountingSection = Section::where('name','Accounting')->where('is_business',True)->first();
        $sectionData = [
            // accounts
            [
                'name' => 'accounts',
                'description' => 'Accounts',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.accounts',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountCreate',
                'description' => 'Account Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountStore',
                'description' => 'Account Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountShow',
                'description' => 'Account Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountEdit',
                'description' => 'Account Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountUpdate',
                'description' => 'Account Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountDelete',
                'description' => 'Account Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountRestore',
                'description' => 'Account Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.restore',
                'section_id' => $accountingSection->id,
            ],
            // account deposit create
            [
                'name' => 'accountDepositCreate',
                'description' => 'Account Deposit Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.deposit.create',
                'section_id' => $accountingSection->id,
            ],
            // account liability create
            [
                'name' => 'accountLiabilityCreate',
                'description' => 'Account Liability Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.liability.create',
                'section_id' => $accountingSection->id,
            ],
            // account loan create
            [
                'name' => 'accountLoanCreate',
                'description' => 'Account Loan Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.loan.create',
                'section_id' => $accountingSection->id,
            ],
            // account withdrawal create
            [
                'name' => 'accountWithdrawalCreate',
                'description' => 'Account Withdrawal Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.withdrawal.create',
                'section_id' => $accountingSection->id,
            ],
            // deposits
            [
                'name' => 'depositStore',
                'description' => 'Deposit Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'depositShow',
                'description' => 'Deposit Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'depositUpdate',
                'description' => 'Deposit Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'depositDelete',
                'description' => 'Deposit Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'depositRestore',
                'description' => 'Deposit Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.restore',
                'section_id' => $accountingSection->id,
            ],
            // deposit account adjustment create
            [
                'name' => 'depositAccountAdjustmentCreate',
                'description' => 'Deposit Account Adjustment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.deposit.account.adjustment.create',
                'section_id' => $accountingSection->id,
            ],
            // account adjustment
            [
                'name' => 'accountAdjustmentCreate',
                'description' => 'Account Adjustment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountAdjustmentStore',
                'description' => 'Account Adjustment Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountAdjustmentEdit',
                'description' => 'Account Adjustment Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountAdjustmentUpdate',
                'description' => 'Account Adjustment Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountAdjustmentDelete',
                'description' => 'Account Adjustment Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'accountAdjustmentRestore',
                'description' => 'Account Adjustment Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.account.adjustment.restore',
                'section_id' => $accountingSection->id,
            ],
            // expenses
            [
                'name' => 'expenses',
                'description' => 'Expenses',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expenses',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseCreate',
                'description' => 'Expense Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseStore',
                'description' => 'Expense Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseShow',
                'description' => 'Expense Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseEdit',
                'description' => 'Expense Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseUpdate',
                'description' => 'Expense Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseDelete',
                'description' => 'Expense Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'expenseRestore',
                'description' => 'Expense Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.restore',
                'section_id' => $accountingSection->id,
            ],
            // expense product delete
            [
                'name' => 'expenseProductDelete',
                'description' => 'Expense Product Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.product.delete',
                'section_id' => $accountingSection->id,
            ],
            // expense product restore
            [
                'name' => 'expenseProductRestore',
                'description' => 'Expense Product Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.expense.product.restore',
                'section_id' => $accountingSection->id,
            ],
            // liabilities
            [
                'name' => 'liabilities',
                'description' => 'Liabilities',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liabilities',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityCreate',
                'description' => 'Liability Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityStore',
                'description' => 'Liability Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityShow',
                'description' => 'Liability Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityEdit',
                'description' => 'Liability Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityUpdate',
                'description' => 'Liability Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityDelete',
                'description' => 'Liability Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'liabilityRestore',
                'description' => 'Liability Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.restore',
                'section_id' => $accountingSection->id,
            ],
            // liability expense create
            [
                'name' => 'liabilityExpenseCreate',
                'description' => 'Liability Expense Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.liability.expense.create',
                'section_id' => $accountingSection->id,
            ],
            // loans
            [
                'name' => 'loans',
                'description' => 'Loans',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loans',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanCreate',
                'description' => 'Loan Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanStore',
                'description' => 'Loan Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanShow',
                'description' => 'Loan Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanEdit',
                'description' => 'Loan Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanUpdate',
                'description' => 'Loan Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanDelete',
                'description' => 'Loan Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'loanRestore',
                'description' => 'Loan Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.restore',
                'section_id' => $accountingSection->id,
            ],
            // loan expense create
            [
                'name' => 'loanPaymentCreate',
                'description' => 'Loan Payment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.loan.payment.create',
                'section_id' => $accountingSection->id,
            ],
            // payments
            [
                'name' => 'payments',
                'description' => 'Payments',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payments',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'paymentCreate',
                'description' => 'Payment Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'paymentStore',
                'description' => 'Payment Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'paymentShow',
                'description' => 'Payment Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'paymentDelete',
                'description' => 'Payment Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'paymentRestore',
                'description' => 'Payment Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.restore',
                'section_id' => $accountingSection->id,
            ],
            // payment refund create
            [
                'name' => 'refundCreate',
                'description' => 'Payment Refund Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.payment.refund.create',
                'section_id' => $accountingSection->id,
            ],
            // refunds
            [
                'name' => 'refunds',
                'description' => 'Refunds',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refunds',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundStore',
                'description' => 'Refund Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundShow',
                'description' => 'Refund Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundEdit',
                'description' => 'Refund Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundUpdate',
                'description' => 'Refund Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundDelete',
                'description' => 'Refund Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'refundRestore',
                'description' => 'Refund Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.refund.restore',
                'section_id' => $accountingSection->id,
            ],
            // transactions
            [
                'name' => 'transactions',
                'description' => 'Transactions',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transactions',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionCreate',
                'description' => 'Transaction Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionStore',
                'description' => 'Transaction Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionShow',
                'description' => 'Transaction Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionEdit',
                'description' => 'Transaction Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionUpdate',
                'description' => 'Transaction Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionDelete',
                'description' => 'Transaction Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transactionRestore',
                'description' => 'Transaction Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.restore',
                'section_id' => $accountingSection->id,
            ],
            // transaction billed
            [
                'name' => 'transactionBilled',
                'description' => 'Transaction Billed',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.billed',
                'section_id' => $accountingSection->id,
            ],
            // transaction pending payment
            [
                'name' => 'transactionPendingPayment',
                'description' => 'Transaction Pending Payment',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transaction.pending.payment',
                'section_id' => $accountingSection->id,
            ],
            // transfers
            [
                'name' => 'transfers',
                'description' => 'Transfers',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfers',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferCreate',
                'description' => 'Transfer Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.create',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferStore',
                'description' => 'Transfer Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.store',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferShow',
                'description' => 'Transfer Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.show',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferEdit',
                'description' => 'Transfer Edit',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.edit',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferUpdate',
                'description' => 'Transfer Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.update',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferDelete',
                'description' => 'Transfer Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.delete',
                'section_id' => $accountingSection->id,
            ],
            [
                'name' => 'transferRestore',
                'description' => 'Transfer Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.restore',
                'section_id' => $accountingSection->id,
            ],
            // transfer billed
            [
                'name' => 'transferExpenseCreate',
                'description' => 'Transfer Expense Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.transfer.expense.create',
                'section_id' => $accountingSection->id,
            ],
        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }


        // settings
        $dashboardSection = Section::where('name','Settings')->where('is_business',True)->first();
        $sectionData = [
            // campaign types
            [
                'name' => 'campaignTypes',
                'description' => 'Campaign Types',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.types',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeCreate',
                'description' => 'Campaign Type Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeStore',
                'description' => 'Campaign Type Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeShow',
                'description' => 'Campaign Type Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeUpdate',
                'description' => 'Campaign Type Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeDelete',
                'description' => 'Campaign Type Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'campaignTypeRestore',
                'description' => 'Campaign Type Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.restore',
                'section_id' => $dashboardSection->id,
            ],
            // campaign type campaign create
            [
                'name' => 'campaignTypeCampaignCreate',
                'description' => 'Campaign Type Campaign Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.campaign.type.campaign.create',
                'section_id' => $dashboardSection->id,
            ],
            // contact types
            [
                'name' => 'contactTypes',
                'description' => 'Contact Types',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.types',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeCreate',
                'description' => 'Contact Type Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeStore',
                'description' => 'Contact Type Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeShow',
                'description' => 'Contact Type Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeUpdate',
                'description' => 'Contact Type Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeDelete',
                'description' => 'Contact Type Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'contactTypeRestore',
                'description' => 'Contact Type Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.contact.type.restore',
                'section_id' => $dashboardSection->id,
            ],
            // frequencies
            [
                'name' => 'frequencies',
                'description' => 'Frequency',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequencies',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesCreate',
                'description' => 'Frequency Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesStore',
                'description' => 'Frequency Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesShow',
                'description' => 'Frequency Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesUpdate',
                'description' => 'Frequency Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesDelete',
                'description' => 'Frequency Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'frequenciesRestore',
                'description' => 'Frequency Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.frequency.restore',
                'section_id' => $dashboardSection->id,
            ],
            // lead sources
            [
                'name' => 'leadSources',
                'description' => 'Lead Sources',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.sources',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceCreate',
                'description' => 'Lead Source Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceStore',
                'description' => 'Lead Source Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceShow',
                'description' => 'Lead Source Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceUpdate',
                'description' => 'Lead Source Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceDelete',
                'description' => 'Lead Source Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'leadSourceRestore',
                'description' => 'Lead Source Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.restore',
                'section_id' => $dashboardSection->id,
            ],
            // titles
            [
                'name' => 'titles',
                'description' => 'Titles',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.sources',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleCreate',
                'description' => 'Title Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleStore',
                'description' => 'Title Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleShow',
                'description' => 'Title Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleUpdate',
                'description' => 'Title Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleDelete',
                'description' => 'Title Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'titleRestore',
                'description' => 'Title Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.restore',
                'section_id' => $dashboardSection->id,
            ],
            // units
            [
                'name' => 'units',
                'description' => 'Units',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.sources',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitCreate',
                'description' => 'Unit Create',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.create',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitStore',
                'description' => 'Unit Store',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.store',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitShow',
                'description' => 'Unit Show',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.show',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitUpdate',
                'description' => 'Unit Update',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.update',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitDelete',
                'description' => 'Unit Delete',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.delete',
                'section_id' => $dashboardSection->id,
            ],
            [
                'name' => 'unitRestore',
                'description' => 'Unit Restore',
                'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
                'user_id' => 1,
                'route' => 'business.lead.source.restore',
                'section_id' => $dashboardSection->id,
            ],

        ];
        foreach ($sectionData as $entry) {
            \App\Menu::create(
                $entry
            );
        }

    }
}
