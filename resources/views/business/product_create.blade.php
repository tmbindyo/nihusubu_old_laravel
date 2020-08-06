@extends('business.layouts.app')

@section('title', 'Products')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li class="active">
                    <a href="{{route('business.products',$institution->portal)}}">Products</a>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Products</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="">
                        <form method="post" enctype="multipart/form-data" action="{{ route('business.product.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
{{--                            <br>--}}
                            {{--  Product  --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    {{--  Product type  --}}
                                    {{--  todo only one should be selectable  --}}
                                    @if ($errors->has('product_type'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('product_type') }}</strong>
                                        </span>
                                    @endif
                                    <label>Product Type</label><br>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="goods" value="goods" class="{{ $errors->has('product_type') ? ' is-invalid' : '' }}" name="product_type" checked="" onclick = "productTypeSelected(this)">
                                        <label for="goods"> Goods </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="services" value="services" class="{{ $errors->has('product_type') ? ' is-invalid' : '' }}" name="product_type" onclick = "productTypeSelected(this)">
                                        <label for="services"> Service </label>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="row">
                                        @if ($errors->has('unit'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-lg-11">
                                            <div class="has-warning">
                                                <select name="unit" class="select2_unit form-control input-lg {{ $errors->has('unit') ? ' is-invalid' : '' }}" required>
                                                    <option></option>
                                                    @foreach($units as $unit)
                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @endforeach()
                                                </select>
                                                <i>unit</i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="The item will be measured in terms of this unit (e.g.:kg,dozen,litres)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        @if ($errors->has('brand'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('brand') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-lg-11">
                                            <div class="has-warning">
                                                <select name="brand" class="select2_brand form-control input-lg {{ $errors->has('brand') ? ' is-invalid' : '' }}">
                                                    <option></option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach()
                                                </select>
                                                <i>brand</i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a brand." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        @if ($errors->has('product_category'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('product_category') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-lg-11">
                                            <div class="has-warning">
                                                <select name="product_sub_category" class="select2_product_sub_category form-control input-lg {{ $errors->has('product_sub_category') ? ' is-invalid' : '' }}">
                                                    <option></option>
                                                    @foreach($productSubCategories as $productSubCategory)
                                                        <option value="{{$productSubCategory->id}}">{{$productSubCategory->name}}</option>
                                                    @endforeach()
                                                </select>
                                                <i>product category</i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a product category." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>
                                    </div>
                                    <br>
                                    @if ($errors->has('is_returnable'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('is_returnable') }}</strong>
                                        </span>
                                    @endif
                                    <div class="checkbox">
                                        <input id="is_returnable" name="is_returnable" type="checkbox" class="{{ $errors->has('is_returnable') ? ' is-invalid' : '' }}">
                                        <label for="is_returnable">
                                            Returnable Product
                                        </label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-2x fa-question-circle"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="file-loading">
                                            <input id="file-1" type="file" name="file[]" multiple class="file  {{ $errors->has('file') ? ' is-invalid' : '' }}" data-overwrite-initial="false" data-min-file-count="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            <label>Description.</label>
                            {{--  Description  --}}
                            <textarea id="summernote" class="summernote {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">
                                <h3>Sample description format</h3>
                                    dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry</strong> standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                    <br/>
                                    <br/>
                                    <ul>
                                        <li>Remaining essentially unchanged</li>
                                        <li>Make a type specimen book</li>
                                        <li>Unknown printer</li>
                                    </ul>
                            </textarea>

                            <hr>

                            {{--  Sales and purchase information  --}}
                            <h3 class="text-center">SALES AND PURCHASE INFORMATION</h3>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-center">SALES INFORMATION</h4>
                                    {{--  Product purchase account  --}}
                                    <div class="row">
                                        @if ($errors->has('selling_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('selling_account') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <select name="selling_account" class="select2_selling_account form-control input-lg {{ $errors->has('selling_account') ? ' is-invalid' : '' }}" required>
                                                <option></option>
                                                @foreach($salesAccounts as $account)
                                                    <option value="{{$account->id}}">{{$account->name}}</option>
                                                @endforeach()
                                            </select>
                                            <i>selling account</i>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-center">PURCHASE INFORMATION</h4>
                                    {{--  Product selling account  --}}
                                    <div class="row">
                                        @if ($errors->has('purchase_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('purchase_account') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <div class="has-warning">
                                                <select name="purchase_account" class="select2_purchase_account form-control input-lg {{ $errors->has('purchase_account') ? ' is-invalid' : '' }}" required>
                                                    <option></option>
                                                    <optgroup label="Exepense">
                                                        @foreach($expenseAccounts as $account)
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach()
                                                    </optgroup>

                                                    <optgroup label="Costs Of Goods Sold">
                                                        @foreach($costOfGoodsSoldAccounts as $account)
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach()
                                                    </optgroup>

                                                </select>
                                                <i>purchase account</i>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    {{--  Selling price  --}}
                                    @if ($errors->has('selling_price'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('selling_price') }}</strong>
                                        </span>
                                    @endif
                                    <div class="has-warning">
                                        <input type="number" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" required="required" placeholder="Selling Price" class="form-control input-lg {{ $errors->has('selling_price') ? ' is-invalid' : '' }}">
                                        <i>selling price</i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--  Purchase price  --}}
                                    @if ($errors->has('purchase_price'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('purchase_price') }}</strong>
                                        </span>
                                    @endif
                                    <div class="has-warning">
                                        <input type="number" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" required="required" placeholder="Purchase Price" class="form-control input-lg {{ $errors->has('purchase_price') ? ' is-invalid' : '' }}">
                                        <i>purchase price</i>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    {{--  Product Tax  --}}
                                    @if ($errors->has('taxes'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('taxes') }}</strong>
                                            </span>
                                    @endif
                                    <select name="taxes[]" class="select2_taxes form-control input-lg {{ $errors->has('taxes') ? ' is-invalid' : '' }}" required multiple>
                                        <option></option>
                                        @foreach($taxes as $tax)
                                            <option value="{{$tax->id}}">{{$tax->name}}[{{$tax->amount}}@if($tax->is_percentage == True)%@endif]</option>
                                        @endforeach()
                                    </select>
                                    <i>taxes</i>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <h3 class="text-center">PRODUCT CREATION INFORMATION</h3>
                                <div class="col-md-6">
                                    @if ($errors->has('is_created'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('is_created') }}</strong>
                                        </span>
                                    @endif
                                    <div class="checkbox checkbox-info">
                                        <input id="is_created" name="is_created" type="checkbox" class="{{ $errors->has('is_created') ? ' is-invalid' : '' }}">
                                        <label for="is_created">
                                            Product Manufactured/Created
                                        </label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-2x fa-question-circle"></i></span>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($errors->has('creation_time'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('creation_time') }}</strong>
                                        </span>
                                    @endif
                                    <input type="number" id="creation_time" name="creation_time" placeholder="Creation/Value addition time" value="{{ old('creation_time') }}" class="form-control input-lg  {{ $errors->has('creation_time') ? ' is-invalid' : '' }}">
                                    <i>Average time taken to manufacture/create or add value to it in minutes.</i>
                                </div>
                                <div class="col-md-6">
                                    @if ($errors->has('creation_cost'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('creation_cost') }}</strong>
                                        </span>
                                    @endif
                                    <input type="number" id="creation_cost" name="creation_cost" value="{{ old('creation_cost') }}" placeholder="Average Creation/Value Addition cost" class="form-control input-lg {{ $errors->has('creation_cost') ? ' is-invalid' : '' }}">
                                    <i>Average cost of manufacturing/creation or value addition process. Include items acquired and cost of time.</i>
                                </div>
                            </div>
                            <hr>

                            {{--  Inventory information  --}}
                            <h3 class="text-center" name = "inventory_information_header">INVENTORY INFORMATION</h3>
                            <br>
                            <div class="checkbox checkbox-primary">
                                <input id="is_inventory" name="is_inventory" type="checkbox" checked="checked" onclick="notInventory(this)" class="{{ $errors->has('is_inventory') ? ' is-invalid' : '' }}">
                                <label for="is_inventory">
                                    Track Inventory for this item
                                </label>
                                <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-2x fa-question-circle"></i></span>
                            </div>
                            <br>
                            <div class="row" name = "inventory_information_label">
                                <div class="col-md-6">
                                    {{--  Inventory account  --}}
                                    <div class="row">
                                        @if ($errors->has('inventory_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('inventory_account') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <div class="has-warning">
                                                <select name="inventory_account" name="inventory_account"  class="select2_inventory_account form-control input-lg {{ $errors->has('inventory_account') ? ' is-invalid' : '' }}" required>
                                                    <option></option>
                                                    @foreach($stockAccounts as $account)
                                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                                    @endforeach()
                                                </select>
                                            </div>
                                            <i>inventory account</i>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <br>
                            <div class="row" name = "inventory_information">
                                <div class="col-md-6">
                                    {{--  Opening stock  --}}
                                    <div class="row">
                                        @if ($errors->has('opening_stock'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('opening_stock') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <input type="number" id="opening_stock" name="opening_stock" value="{{ old('opening_stock') }}" required="required" class="form-control input-lg inventory {{ $errors->has('opening_stock') ? ' is-invalid' : '' }}" placeholder="Opening Stock">
                                            <i>opening stock</i>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--  Opening stock value  --}}
                                    {{--  todo Make KES (currency) dynamic  --}}
                                    <div class="row">
                                        @if ($errors->has('opening_stock_value'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('opening_stock_value') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <input type="number" id="opening_stock_value" name="opening_stock_value" value="{{ old('opening_stock_value') }}" required="required" class="form-control input-lg inventory {{ $errors->has('opening_stock_value') ? ' is-invalid' : '' }}" placeholder="Opening Stock Value">
                                            <i>opening stock value</i>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="Opening stock value refers to the average purchase price of your opening stock. (Per unit in KES)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" name = "inventory_information">
                                <div class="col-md-6">
                                    {{--  Reorder Level  --}}
                                    <div class="row">
                                        @if ($errors->has('reorder_level'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('reorder_level') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-11">
                                            <input type="number" id="reorder_level" name="reorder_level" value="{{ old('reorder_level') }}" required="required" class="form-control input-lg inventory  {{ $errors->has('reorder_level') ? ' is-invalid' : '' }}" placeholder="Reorder Level">
                                            <i>reorder level</i>
                                        </div>
                                        <div class="col-md-1">
                                            <span><i data-toggle="tooltip" data-placement="right" title="Reorder level refers to the quantity of an item below which, an item is considered to be low on stock." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <hr>
                            <br />

                            <div class="ln_solid"></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block btn-lg btn-outline mt-4">{{ __('Save') }}</button>
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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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

    <!-- SUMMERNOTE -->
    <script src="{{ asset('inspinia') }}/js/plugins/summernote/summernote.min.js"></script>

    <!-- DROPZONE -->
    <script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>

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
        $(document).ready(function(){
            Dropzone.options.myDropzone= {
                url: 'upload.php',
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 12,
                maxFilesize: 3,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                init: function() {
                    dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

                    // for Dropzone to process the queue (instead of default form behavior):
                    document.getElementById("submit-all").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });

                    //send all the form data along with the files:
                    this.on("sendingmultiple", function(data, xhr, formData) {
                        formData.append("firstname", jQuery("#firstname").val());
                        formData.append("lastname", jQuery("#lastname").val());
                    });
                }
            }
        });
    </script>

    <script>
        function productTypeSelected (e) {
            var checkBox = document.getElementById("is_inventory");
            console.log(checkBox)
            if (e.value === "goods") {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (input of parent.getElementsByTagName("input")){
                        // Removing the readonly attribute
                        input.removeAttribute("readonly", true)
                    }
                }
                // Enabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.removeAttribute("disabled", true)
                // Instance of chosen on the select element
                $(".inventory-account-chosen").chosen(
                    {allow_single_deselect:true},
                    {disable_search_threshold:10},
                    {no_results_text:'Oops, nothing found!'},
                    {width:"95%"}
                );
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION"
            } else if (e.value === "services") {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (inputElement of parent.getElementsByTagName("input")){
                        // Setting each element to readonly
                        inputElement.setAttribute("readonly", true)
                    }
                }
                // Destroying the instance of chosen that was making it hard to disable the inventory account select element
                $(".inventory-account-chosen").chosen("destroy");
                // Disabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.setAttribute("disabled", true)
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION (Not Applicable for a Service)"
            }
        }

    </script>

    <script>
        function notInventory (e) {
            console.log("e.value")
            console.log(e)
            if (e.checked == true) {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (input of parent.getElementsByTagName("input")){
                        // Removing the readonly attribute
                        input.removeAttribute("readonly", true)
                    }
                }
                // Enabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.removeAttribute("disabled", true)
                // Instance of chosen on the select element
                $(".inventory-account-chosen").chosen(
                    {allow_single_deselect:true},
                    {disable_search_threshold:10},
                    {no_results_text:'Oops, nothing found!'},
                    {width:"95%"}
                );
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION"
            } else if (e.checked == false) {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (inputElement of parent.getElementsByTagName("input")){
                        // Setting each element to readonly
                        inputElement.setAttribute("readonly", true)
                    }
                }
                // Destroying the instance of chosen that was making it hard to disable the inventory account select element
                $(".inventory-account-chosen").chosen("destroy");
                // Disabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.setAttribute("disabled", true)
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION (Not tracking for this product)"
            }
        }

    </script>

    <script>
        $(document).ready(function(){

            $(".select2_unit").select2({
                placeholder: "Select Unit",
                allowClear: true
            });

            $(".select2_brand").select2({
                placeholder: "Select Brand",
                allowClear: true
            });

            $(".select2_selling_account").select2({
                placeholder: "Select Selling Account",
                allowClear: true
            });

            $(".select2_product_sub_category").select2({
                placeholder: "Select Product Sub Category",
                allowClear: true
            });

            $(".select2_purchase_account").select2({
                placeholder: "Select Purchase Account",
                allowClear: true
            });

            $(".select2_taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true
            });

            $(".select2_inventory_account").select2({
                placeholder: "Select Inventory Account",
                allowClear: true
            });

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
            $(".select2_unit").select2({
                placeholder: "Select Unit",
                allowClear: true
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

        $(".select2").select2();

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

    </script>


@endsection
