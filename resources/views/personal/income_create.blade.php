@extends('personal.layouts.app')

@section('title', ' Income Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Income Create</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('personal.income')}}">Income</a>
                </li>
                <li class="active">
                    <strong>Create Income</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="">
                            <form method="post" action="{{ route('personal.income.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                        {{--  Income varibale or fixed  --}}
                                        {{--  todo only one should be selectable  --}}
                                        <p>Income Type</p>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="variable" value="option1" name="variable" checked="">
                                            <label for="inlineRadio1"> Variable </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="fixed" value="option2" name="fixed">
                                            <label for="inlineRadio2"> Fixed </label>
                                        </div>
                                        {{--  income name  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <input type="text" id="income_name" name="income_name" required="required" class="form-control input-lg" placeholder="Income name">
                                            <i>Give your income a name</i>
                                        </div>
                                        {{--  income amount  --}}
                                        <div class="">
                                            <label>  </label>
                                            <input type="number" id="income_amount" name="income_amount" required="required" class="form-control input-lg" placeholder="Income amount">
                                            <i>Give your income amount if fixed</i>
                                        </div>
                                        {{--  Income frequency  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <select class="select2_demo_3 form-control input-lg">
                                                <option>Select Frequency</option>
                                                <option value="Bahamas">Bahamas</option>
                                            </select>
                                        </div>
                                        <br>
                                        {{--  Income account  --}}
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Account to which this income will be deposited." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        {{--  TODO Thumbnail  --}}
                                    </div>
                                </div>

                                {{--  Product information  --}}
                                <div class="row">

                                </div>
                                <div class="">
                                    {{--  Income description  --}}
                                    <label>  </label>
                                    <textarea rows="5" placeholder="Income description" class="form-control input-lg"></textarea>
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
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>


@endsection
