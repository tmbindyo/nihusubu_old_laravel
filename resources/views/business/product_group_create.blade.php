@extends('business.layouts.app')

@section('title', 'Create Product Group')

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
        <h2>Product Groups</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.products')}}">Products</a>
            </li>
            <li>
                <a href="{{route('business.product.groups')}}">Product Groups</a>
            </li>
            <li class="active">
                <strong>Product Group Create</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Product Groups</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.product.group.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                {{--  Product type  --}}
                                {{--  todo only one should be selectable  --}}
                                <p>Product Type</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="good" value="option1" name="good" checked="">
                                    <label for="inlineRadio1"> Goods </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="option2" name="service">
                                    <label for="inlineRadio2"> Service </label>
                                </div>
                                <label>  </label>
                                {{--  Product group name  --}}
                                <div class="has-warning">
                                    <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg" placeholder="Product Group Name">
                                    <i>Give your product group a name</i>
                                </div>
                                <label>  </label>
                                {{--  Product group description  --}}
                                <div class="has-warning">
                                    <textarea rows="5" id="product_description" name="product_description" required="required" class="form-control input-lg"></textarea>
                                    <i>Describe your product group.</i>
                                </div>
                                {{--  Product returnable  --}}
                                {{--todo description tooltip--}}
                                <div class="">
                                    <input id="returnable" name="returnable" type="checkbox">
                                    <label for="returnable">
                                        Returnable Product
                                    </label>
                                    <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if all the items in the group are eligible for sales return." class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{--  TODO Thumbnail  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                {{--  Product Unit  --}}
                                <div class="">
                                    <select class="select2_demo_3 form-control input-lg">
                                        <option>Select Unit</option>
                                        <option value="Bahamas">Bahamas</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                {{--  Product Tax  --}}
                                <select class="select2_demo_3 form-control input-lg">
                                    <option>Select Tax</option>
                                    <option value="Bahamas">Bahamas</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                {{--  Product Manufacturer  --}}
                                <select class="select2_demo_3 form-control input-lg">
                                    <option>Select Manufacturer</option>
                                    <option value="Bahamas">Bahamas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                {{--  Product Brand  --}}
                                <select class="select2_demo_3 form-control input-lg">
                                    <option>Select Brand</option>
                                    <option value="Bahamas">Bahamas</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="product_group_attribute">
                            <div class="col-md-6">
                                {{--  Product Group attribute  --}}
                                <div class="row">
{{--                                    <label class="text-danger">Attribute</label>--}}
                                    <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes for the product groups, can be a range of different colors of one product, or sizes. " class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute" class="form-control input-lg" placeholder="e.g Color" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    {{--                                    <label class="text-danger">Attribute</label>--}}
                                    <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes options, if the attribut is color, we can have a black, blue, green, white or grey variation of the same product." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute_options" class="input-lg" name="attribute_options" id="tag-input" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-success"><i class="fa fa-plus" ></i>Add more attributes</label>
                            </div>
                        </div>

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
