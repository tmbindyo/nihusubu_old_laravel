@extends('business.layouts.app')

@section('title', 'Create Inventory Adjustment')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
    {{--  Tags  --}}
    <style>
        .tags-input-wrapper {
            background: #ffffff;
            padding: 10px;
            border-radius: 4px;
            max-width: 650px;
            border: 1px solid #ccc
        }

        .tags-input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            width: 150px;
        }

        .tags-input-wrapper .tag {
            display: inline-block;
            background-color: #009432;
            color: white;
            border-radius: 20px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection



@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Inventory Adjustment</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.warehouses')}}">Inventory</a>
            </li>
            <li>
                <a href="{{route('business.inventory.adjustments')}}">Inventory Adjustments</a>
            </li>
            <li class="active">
                <strong>Inventory Adjustment Create</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Create Inventory Adjustment</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.inventory.adjustment.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                            <div class="col-md-8">
                                {{--  Mode of adjustment  --}}
                                {{--  todo only one should be selectable  --}}
                                <p>Mode of adjustment</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="good" value="option1" name="good" checked="">
                                    <label for="inlineRadio1"> Quantity Adjustment </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="option2" name="service">
                                    <label for="inlineRadio2"> Value Adjustment </label>
                                </div>
                                <label>  </label>
                                {{--  Reference  --}}
                                <div class="">
                                    <input type="text" id="reference" name="reference" class="form-control input-lg" placeholder="Reference">
                                    <i>Give your product group a name</i>
                                </div>
                                <label>  </label>
                                {{--  Account  --}}
                                <div class="has-warning">
                                    <label class="text-danger"></label>
                                    <select name="account" class="select2_demo_3 form-control input-lg">
                                        <option>Select Account</option>
                                        <option value="Bahamas">Bahamas</option>
                                    </select>
                                </div>
                                <label>  </label>
                                {{--  Reason  --}}
                                <div class="has-warning">
                                    <textarea rows="3" id="reason" name="reason" required="required" class="form-control input-lg" placeholder="Reason"></textarea>
                                    <i>Describe your product group.</i>
                                </div>
                                <label>  </label>
                                {{--  Warehouse  --}}
                                <div class="has-warning">
                                    <select name="account" class="select2_demo_3 form-control input-lg">
                                        <option>Select Account</option>
                                        <option value="Bahamas">Bahamas</option>
                                    </select>
                                </div>
                                <label>  </label>
                                {{--  Description  --}}
                                <div class="">
                                    <textarea rows="5" id="description" name="description" class="form-control input-lg" placeholder="Description"></textarea>
                                    <i>Describe your product group.</i>
                                </div>



                            </div>
                            <div class="col-md-4">
                                {{--  TODO Thumbnail  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="ibox-title">
                                <h5>Border Table </h5>
                            </div>
                            <div class="ibox-content">

                                <table class="table table-bordered" id = "adjustment_table">
                                    <thead>
                                    <tr>
                                        <th>Item Details</th>
                                        <th width="210px">Stock On Hand</th>
                                        <th width="210px">New Quantity On Hand</th>
                                        <th width="210px">Quantity Adjusted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select class="select2_demo_3 form-control input-lg" name = "item_details[0][details]">
                                                <option>Select Item</option>
                                                <option value="Bahamas">Bahamas</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg" name = "item_details[0][on_hand]">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg" name = "item_details[0][new_on_hand]">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg" placeholder="E.g +10, -10" name = "item_details[0][adjusted]">
                                        </td>
                                        <td width="10px">
                                            <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-times-circle fa-2x text-danger"></i></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
                            </div>
                        </div>
                        <hr>
                        <br>

                        <div class="ln_solid"></div>

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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- jQuery Tags Input -->
    <script src="{{ asset('js') }}/tagplug-master/index.js"></script>

    {{--  Tag script  --}}
    <script>
        $(document).ready(function() {
            var tagInput = new TagsInput({
                selector: 'tag-input',
                duplicate: false
            });
        });
        var adj_array_index = 1
        // Function to add table rows
        function addTableRow() {
            var table = document.getElementById("adjustment_table")
            var row = table.insertRow()
            var first_cell = row.insertCell(0)
            var second_cell = row.insertCell(1)
            var third_cell = row.insertCell(2)
            var fourth_cell = row.insertCell(3)
            first_cell.innerHTML = "<select class='select2_demo_3 form-control input-lg' name = 'item_details["+adj_array_index+"][details]'><option>Select Item</option><option value='Bahamas'>Bahamas</option></select>"
            second_cell.innerHTML = "<input type='number' class='form-control input-lg' name = 'item_details["+adj_array_index+"][on_hand]'>"
            third_cell.innerHTML = "<input type='number' class='form-control input-lg' name = 'item_details["+adj_array_index+"][new_on_hand]'>"
            fourth_cell.innerHTML = "<input type='number' class='form-control input-lg' placeholder='E.g +10, -10' name = 'item_details["+adj_array_index+"][adjusted]'>"
            adj_array_index++
        };
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
@endsection
