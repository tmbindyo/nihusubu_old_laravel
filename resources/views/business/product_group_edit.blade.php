@extends('business.layouts.app')

@section('title', 'Edit '.$productGroup->name)

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>{{$productGroup->name}} Edit</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li>
                    <a href="#">Products</a>
                </li>
                <li>
                    <strong><a href="{{route('business.product.groups',$institution->portal)}}">Product Groups</a></strong>
                </li>
                <li class="active">
                    <strong>{{$productGroup->name}} Edit</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Product Group Create</h5>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" enctype="multipart/form-data" action="{{ route('business.product.group.update',['portal'=>$institution->portal, 'id'=>$productGroup->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        {{--  Product  --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 b-r">
                                        {{--  Product type  --}}
                                        @if ($errors->has('product_type'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('product_type') }}</strong>
                                            </span>
                                        @endif
                                        <div class="radio radio-inline">
                                            <input type="radio" id="goods" value="goods" name="product_type" @if($productGroup->is_service == 0) checked @endif class="enableService {{ $errors->has('product_type') ? ' is-invalid' : '' }}" disabled>
                                            <label for="goods"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="services" value="services" name="product_type" @if($productGroup->is_service == 1) checked @endif class="enableService {{ $errors->has('product_type') ? ' is-invalid' : '' }}" disabled>
                                            <label for="services"> Service </label>
                                        </div>
                                        <br>
                                        <i>product type</i>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Product returnable  --}}
                                        <div class="checkbox">
                                            @if ($errors->has('is_returnable'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('is_returnable') }}</strong>
                                                </span>
                                            @endif
                                            <input id="is_returnable" name="is_returnable" type="checkbox" class=" {{ $errors->has('is_returnable') ? ' is-invalid' : '' }}">
                                            <label for="is_returnable">
                                                Returnable Product
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-x text-warning fa-question-circle"></i></span>
                                        </div>
                                    </div>
                                </div>



                                <br>
                                <br>

                                {{--  Product group name  --}}
                                <div class="has-warning">
                                    @if ($errors->has('product_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('product_name') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg {{ $errors->has('product_name') ? ' is-invalid' : '' }}" value="{{$productGroup->name}}">
                                    <i>name</i>
                                </div>
                                <br>
                                {{--  Product Unit  --}}
                                <div class="has-warning">
                                    @if ($errors->has('unit'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('unit') }}</strong>
                                        </span>
                                    @endif
                                    <select name="unit" class="select form-control input-lg {{ $errors->has('unit') ? ' is-invalid' : '' }}" required>
                                        <option value="" selected disabled>Select Unit</option>
                                        @foreach($units as $unit)
                                            <option @if ($unit->id == $productGroup->unit_id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach()
                                    </select>
                                    <i>unit</i> <span><i data-toggle="tooltip" data-placement="right" title="The item will be measured in terms of this unit (e.g.:kg,dozen,litres)" class="fa fa-question-circle fa-x text-warning"></i></span>
                                </div>

                                <br>

                                <div class="has-warning">
                                    @if ($errors->has('brand'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @endif
                                    <select name="brand" class="select2_brand form-control input-lg {{ $errors->has('brand') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        @foreach($brands as $brand)
                                            <option @if($productGroup->brand_id == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach()
                                    </select>
                                    <i>brand</i> <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a brand." class="fa fa-question-circle fa-x text-warning"></i></span>
                                </div>

                                <br>

                                <div class="has-warning">
                                    @if ($errors->has('product_sub_category'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('product_sub_category') }}</strong>
                                        </span>
                                    @endif
                                    <select name="product_sub_category" class="select2_product_sub_category form-control input-lg {{ $errors->has('product_sub_category') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        @foreach($productSubCategories as $productSubCategory)
                                            <option @if($productGroup->product_sub_category_id == $productSubCategory->id) selected @endif value="{{$productSubCategory->id}}">{{$productSubCategory->name}}</option>
                                        @endforeach()
                                    </select>
                                    <i>product sub category</i> <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a product category." class="fa fa-question-circle fa-x text-warning"></i></span>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Product Images
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-groups">
                                            <div class="file-loading">
                                                <input id="file-1" type="file" name="file[]" multiple class="file {{ $errors->has('file') ? ' is-invalid' : '' }}" data-overwrite-initial="false" data-min-file-count="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <label>Description.</label>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        {{--  Description  --}}
                        <textarea id="summernote" class="summernote {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">
                            {!! $productGroup->description!!}
                        </textarea>
                        <hr>
                        {{--  Sales and purchase information  --}}
                        <h3 class="text-center">SALES AND PURCHASE INFORMATION</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-center">SALES INFORMATION</h4>
                                {{-- selling account  --}}

                                <div class="has-warning">
                                    @if ($errors->has('selling_account'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('selling_account') }}</strong>
                                        </span>
                                    @endif
                                    <select name="selling_account" class="select2_selling_account form-control input-lg {{ $errors->has('selling_account') ? ' is-invalid' : '' }}" required>
                                        <option></option>
                                        @foreach($salesAccounts as $account)
                                            <option @if($account->id == $productGroup->selling_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                        @endforeach()
                                    </select>
                                    <i>selling account</i> <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-x text-warning"></i></span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <h4 class="text-center">PURCHASE INFORMATION</h4>
                                {{--  Product selling account  --}}
                                <div class="has-warning">
                                    @if ($errors->has('purchase_account'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('purchase_account') }}</strong>
                                        </span>
                                    @endif
                                    <select name="purchase_account" id="purchase_account" class="select2_purchase_account form-control input-lg {{ $errors->has('purchase_account') ? ' is-invalid' : '' }}" required @if($productGroup->is_created) disabled @endif>
                                        <option></option>

                                        <optgroup label="Exepense">
                                            @foreach($expenseAccounts as $account)
                                                <option @if($account->id == $productGroup->purchase_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                            @endforeach()
                                        </optgroup>

                                        <optgroup label="Costs Of Goods Sold">
                                            @foreach($costOfGoodsSoldAccounts as $account)
                                                <option @if($account->id == $productGroup->purchase_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                            @endforeach()
                                        </optgroup>
                                    </select>
                                    <i>purchase account</i> <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-x text-warning"></i></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{--  Inventory information  --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="has-warning">
                                    {{--  Product Tax  --}}
                                    @if ($errors->has('taxes'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('taxes') }}</strong>
                                        </span>
                                    @endif
                                    <select name="taxes[]" class="taxes-select form-control input-lg {{ $errors->has('taxes') ? ' is-invalid' : '' }}" multiple="multiple">
                                        <option></option>
                                        @foreach($taxes as $tax)
                                                <option @foreach($productGroup->productTaxes as $productTax) @if($productTax->tax_id == $tax->id) selected @endif @endforeach() value="{{$tax->id}}">{{$tax->name}}[{{$tax->amount}}@if($tax->is_percentage == True)%@endif]</option>
                                        @endforeach()
                                    </select>
                                    <i>taxes</i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="has-warning">
                                    {{--  Tax method --}}
                                    @if ($errors->has('tax_method'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('tax_method') }}</strong>
                                        </span>
                                    @endif
                                    <select name="tax_method" class="tax_method-select form-control input-lg {{ $errors->has('tax_method') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        @foreach($taxMethods as $taxMethod)
                                            <option @if($productGroup->tax_method_id == $taxMethod->id) selected @endif value="{{$taxMethod->id}}">{{$taxMethod->name}}</option>
                                        @endforeach()
                                    </select>
                                    <i>tax method</i>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center">PRODUCT CREATION INFORMATION</h3>
                        <div class="row">
                            <div class="col-md-2">
                                @if ($errors->has('is_created'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_created') }}</strong>
                                    </span>
                                @endif
                                <div class="checkbox checkbox-info">
                                    <input id="is_created" name="is_created" type="checkbox" @if($productGroup->is_created == 1)checked @endif class="enableCreationInformation {{ $errors->has('is_created') ? ' is-invalid' : '' }}">
                                    <label for="is_created">
                                        Created?
                                    </label>
                                    <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-x text-warning fa-question-circle"></i></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                @if ($errors->has('creation_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('creation_time') }}</strong>
                                    </span>
                                @endif
                                <input type="number" id="creation_time" name="creation_time" required="required" value="{{$productGroup->creation_time}}" class="form-control input-lg  {{ $errors->has('creation_time') ? ' is-invalid' : '' }}" @if($productGroup->is_created == 0) disabled @endif>
                                <i>Average time taken to manufacture/create or add value to it in minutes.</i>
                            </div>
                            <div class="col-md-5">
                                @if ($errors->has('creation_cost'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('creation_cost') }}</strong>
                                    </span>
                                @endif
                                <input type="number" id="creation_cost" name="creation_cost" required="required" value="{{$productGroup->creation_cost}}" class="form-control input-lg  {{ $errors->has('creation_cost') ? ' is-invalid' : '' }}" @if($productGroup->is_created == 0) disabled @endif>
                                <i>Average cost of manufacturing/creation or value addition process. Include items acquired and cost of time.</i>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id = "estimate_table">
                                    <thead>
                                    <tr>
                                        <th>Item Details</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($productGroup->productItems))
                                        @php
                                            $product_index = 0
                                        @endphp
                                        @foreach($productGroup->productItems as $productItem)
                                            <tr>
                                                <td>
                                                    <select id="item_details[{{$product_index}}]" data-placement="Select" name="item_details[{{$product_index}}][item]" class="select2_item_initial form-control input-lg item-select" style = "width: 100%">
                                                        <option></option>
                                                        @foreach($items as $item)
                                                            <option @if($productItem->item_id == $item->id) selected @endif value="{{$item->id}}" data-product-quantity = "-20" data-product-selling-price = "{{$item->taxed_selling_price}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input  id="item_quantity[{{$product_index}}]" onchange = "this.oninput()" name="item_details[{{$product_index}}][amount]" type="number" class="form-control input-lg item-total" value="{{$productItem->quantity}}" min = "0">
                                                </td>
                                                <td>
                                                    <span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>
                                                </td>
                                            </tr>
                                            @php
                                                $product_index++
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <select id="item_details" disabled data-placement="Select" name="item_details[0][item]" class="select2_item_initial form-control input-lg item-select" style = "width: 100%">
                                                    <option></option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item->id}}" data-product-quantity = "-20" data-product-selling-price = "{{$item->taxed_selling_price}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input id="item_quantity" disabled onchange = "this.oninput()" name="item_details[0][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "0" min = "0">
                                            </td>
                                            <td>
                                                <button ><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></button>
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                                <button type="button" id="add_new_item_row" id="add_new_item_row" class="btn btn-small btn-primary" @if(!$productGroup->is_created) disabled @endif onclick = "addTableRow()" dis>+ Add Another Line</button>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center">INVENTORY INFORMATION</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <div class="checkbox checkbox-primary">
                                    <input id="is_inventory" name="is_inventory" type="checkbox" class="enableInventory {{ $errors->has('is_inventory') ? ' is-invalid' : '' }}" @if($productGroup->is_inventory == 0) disabled @elseif($productGroup->is_inventory == 1) checked @endif>
                                    <label for="is_inventory">
                                        Track Inventory for this item
                                    </label>
                                    <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-x text-warning fa-question-circle"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{--  Inventory account  --}}
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <select name="inventory_account" id="inventory_account" class="select2_inventory_account form-control input-lg {{ $errors->has('inventory_account') ? ' is-invalid' : '' }}" @if($productGroup->is_inventory == 0) disabled @endif>
                                                <option></option>
                                                @foreach($stockAccounts as $account)
                                                    <option @if($account->id == $productGroup->inventory_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                @endforeach()
                                            </select>
                                            <i>inventory account</i>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="text-danger"></label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center">PRODUCTS</h3>
                        <br>
                        {{-- <hr> --}}
                        {{-- <div class="row" id="product_group_attribute">
                            <div class="col-md-6"> --}}
                                {{--  Product Group attribute  --}}
                                {{-- <div class="row"> --}}
{{--                                    <label class="text-danger">Attribute</label>--}}
                                    {{-- <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes for the product groups, can be a range of different colors of one product, or sizes. " class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute[]" class="form-control input-lg" placeholder="Attributes e.g Color" required>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="row"> --}}
                                    {{--                                    <label class="text-danger">Attribute</label>--}}
                                    {{-- <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes options, if the attribute is color, we can have a black, blue, green, white or grey variation of the same product." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute_options[]" class="form-control input-lg" id="tag-input" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <table class = "table" id = "attributes_master">
                            <tbody id = "attributes_master_tbody">
                                <tr>
                                    <td style = "width: 50%">
                                        @if ($errors->has('attribute'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('attribute') }}</strong>
                                            </span>
                                        @endif
                                        <div class="has-warning">
                                            <input type="text" name="attribute[]" class="form-control input-lg {{ $errors->has('attribute') ? ' is-invalid' : '' }}" value="{{$productGroup->attributes}}" required>
                                            <br>
                                            <i>attributes</i>
                                        </div>
                                    </td>
                                    <td style = "width: 50%">
                                        @if ($errors->has('attribute_options'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('attribute_options') }}</strong>
                                            </span>
                                        @endif
                                        <div class="has-warning">
                                            <input type="text" value="{{$productAttributes}}" name="attribute_options[]" class="form-control input-lg {{ $errors->has('attribute_options') ? ' is-invalid' : '' }}" id="tag-input" required >
                                            <i>attribute options</i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <div class="ln_solid"></div>

                        <table class="table table-bordered" id = "attribute_table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Opening Stock</th>
                                    <th>Opening Stock Value</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Reorder Level</th>
                                </tr>
                            </thead>
                            <tbody id = "attribute_tbody">
                                @php
                                    $itemIndex = 0;
                                @endphp

                                @foreach ($productGroup->productGroupProducts as $product)
                                    <tr class="gradeA">
                                        <td><input type = 'text' class = 'form-control input-md' name = products[{{$itemIndex}}][name] value = "{{$product->name}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][opening_stock] value = "{{$product->opening_stock}}" @if($product->is_inventory == 0) disabled @endif></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][opening_stock_value] value = "{{$product->opening_stock_value}}" @if($product->is_inventory == 0) disabled @endif></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][purchase_price] value = "{{$product->purchase_price}}" @if(!$product->purchase_price) disabled @endif></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][selling_price] value = "{{$product->selling_price}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][reorder_level] value = "{{$product->reorder_level}}" @if($product->is_inventory == 0) disabled @endif></td>
                                    </tr>
                                    @php
                                        $itemIndex ++;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>

                        <br>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>


@endsection

@section('js')


    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- JSKnob -->
    <script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

    {{--  <!-- Date range use moment.js same as full calendar plugin -->  --}}
    <script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- jQuery Tags Input -->
    <!-- <script src="{{ asset('js') }}/tagplug-master/index.js"></script> -->

    <script src="{{ asset('js') }}/choices.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="{{ asset('inspinia') }}/js/plugins/summernote/summernote.min.js"></script>

    {{-- FILEINPUT --}}
    <script src="{{ asset('inspinia') }}/js/plugins/fileinput/fileinput.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/fileinput/theme.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/popper/popper.min.js"></script>

    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/image-view",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };
    </script>

    <script>
        $(document).ready(function() {

            $('.enableCreationInformation').on('click',function(){
                if (document.getElementById('is_created').checked) {
                    // enable input
                    document.getElementById("creation_time").disabled = false;
                    document.getElementById("creation_cost").disabled = false;
                    // document.getElementById("item_details").disabled = false;
                    // document.getElementById("item_quantity").disabled = false;
                    document.getElementById("add_new_item_row").disabled = false;
                    document.getElementById("purchase_account").disabled = true;
                } else {
                    // disable input
                    document.getElementById("creation_time").disabled = true;
                    document.getElementById("creation_cost").disabled = true;
                    // document.getElementById("item_details").disabled = true;
                    // document.getElementById("item_quantity").disabled = true;
                    document.getElementById("add_new_item_row").disabled = true;
                    document.getElementById("purchase_account").disabled = false;
                }
            });
            $('.enableInventory').on('click',function(){
                if (document.getElementById('is_inventory').checked) {
                    // enable input
                    document.getElementById("inventory_account").disabled = false;
                } else {
                    // disable input
                    document.getElementById("inventory_account").disabled = true;
                }
            });
            $('.enableService').on('click',function(){
                if (document.getElementById('services').checked) {
                    // enable input
                    document.getElementById("is_inventory").checked = false;
                    document.getElementById("is_inventory").disabled = true;
                    document.getElementById("inventory_account").disabled = true;
                } else if(document.getElementById('goods').checked) {
                    // disable input
                    document.getElementById("is_inventory").disabled = false;
                    document.getElementById("is_inventory").checked = true;
                    document.getElementById("inventory_account").disabled = false;
                }
            });


        });

    </script>

    {{--  Tag script  --}}
    <script>
        // https://github.com/jshjohnson/Choices
        var goodsSelected = document.getElementById("goods")
        var creationSelected = document.getElementById("is_created")
        var inventorySelected = document.getElementById("is_inventory")
        var servicesSelected = document.getElementById("services")
        var productName = document.getElementById("product_name")
        var tagField = document.getElementById("tag-input");
        var tagsChoices = new Choices(tagField, {
            delimiter: ', ',
            editItems: true,
            removeItems: true,
            removeItemButton: true,
            duplicateItemsAllowed: false
        });
        // Event handler for adding items
        tagField.addEventListener("addItem", function (event) {
            modifyAttrTable(event.detail, true)
        });
        // Event handler for removing items
        tagField.addEventListener("removeItem", function (event) {
            // This is the only reliable way to remove an element from the store of items in the list...so far
            // console.log(tagsChoices._store.items)
            var itemIndex = event.detail.id - 1 // Item IDs start from 1 rather than 0, hence the need to subtract
            tagsChoices._store.items.splice(itemIndex, 1)
            modifyAttrTable(event.detail, false)
        });
        // Function responsible for propulating the attributes list table whenever a change is made
        function modifyAttrTable (tagItem, addItem) {
            var tableBody = document.getElementById("attribute_tbody")
            var itemIndex = tagItem.id - 1 // See explanation in tagField.addEventListener("addItem")
            if (addItem === true) {
                var row = tableBody.insertRow(itemIndex)
                var first_cell = row.insertCell(0)
                var second_cell = row.insertCell(1)
                var third_cell = row.insertCell(2)
                var fourth_cell = row.insertCell(3)
                var fifth_cell = row.insertCell(4)
                var sixth_cell = row.insertCell(5)
                // var seventh_cell = row.insertCell(6)
                first_cell.innerHTML = "<input type = 'text' class = 'form-control input-md' name = products["+itemIndex+"][name] value = ''>"
                if (servicesSelected.checked === true || inventorySelected.checked == false) {
                    second_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock] value = '' readonly>"
                    third_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock_value] value = '' readonly>"
                } else if (goodsSelected.checked === true) {
                    second_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock] value = 0>"
                    third_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock_value] value = 0>"
                }
                if (creationSelected.checked === true || servicesSelected.checked === true) {
                    fourth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products[" + itemIndex + "][purchase_price] value = '' readonly>"
                } else {
                    fourth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][purchase_price] value = 0>"
                }
                fifth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][selling_price] value = 0>"
                if (servicesSelected.checked === true || inventorySelected.checked == false) {
                    sixth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][reorder_level] value = '' readonly>"
                } else if (goodsSelected.checked === true) {
                    sixth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][reorder_level] value = 0>"
                }
                var fieldValue = (productName.value) + "-" + (tagItem.value)
                document.getElementsByName("products["+itemIndex+"][name]")[0].value = fieldValue
            } else if (addItem === false) {
                var row = tableBody.deleteRow(itemIndex)
            }
        };
        function addToAttrMasterTable () {};
    </script>

    {{--  Script to prevent form submit on enter key press  --}}
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select').select2({
                theme: "default"
            }),
            $('.taxes-select').select2({
                theme: "default",
                placeholder: "Select taxes",
            });
            $('.tax_method-select').select2({
                theme: "default",
                placeholder: "Select tax method",
            });
            $(".select2_brand").select2({
                placeholder: "Select Brand",
                allowClear: true
            });
            $(".select2_selling_account").select2({
                placeholder: "Select Selling Account",
                allowClear: true
            });
            $(".select2_purchase_account").select2({
                placeholder: "Select Purchase Account",
                allowClear: true
            });
            $(".select2_inventory_account").select2({
                placeholder: "Select Inventory Account",
                allowClear: true
            });
            $(".select2_product_sub_category").select2({
                placeholder: "Select Product Category",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            /*var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });*/

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

       /* $("#basic_slider").noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#range_slider").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#drag-fixed").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });*/


    </script>

@endsection
