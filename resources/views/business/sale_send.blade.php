@extends('business.layouts.app')

@section('title', ' Sale')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Sale</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.sales',$institution->portal)}}">Sales</a>
                </li>
                <li>
                    <a href="{{ route('business.sale.show', ['portal'=>$institution->portal, 'id'=>$sale->id]) }}">Sale</a>
                </li>
                <li class="active">
                    <strong>Sale</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-6">
            <div class="title-action">

            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="pull-right tooltip-demo">
{{--                        <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>--}}
{{--                        <a href="mailbox.html" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>--}}
                    </div>
                    <h2>
                        Compse mail
                    </h2>
                </div>
                <div class="mail-box">


                    <form class="form-horizontal" method="post" action="{{ route('business.sale.send',['portal'=>$institution->portal,'sale_id'=>$sale->id]) }}">
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
                        <div class="mail-body">


                            <div class="form-group">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <label class="col-sm-2 control-label">To:</label>
                                <div class="col-sm-10">
                                    <input name="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$sale->contact->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                                <label class="col-sm-2 control-label">Subject:</label>
                                <div class="col-sm-10">
                                    <input name="subject" type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" value="Sale ref #{{$sale->reference}}">
                                </div>
                            </div>
                        </div>

                        <div class="mail-text h-200">
                            @if ($errors->has('body'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                            <textarea class="summernote {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body">
                                <h3>Hello Jonathan! </h3>
                                dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                <br/>
                                <br/>

                            </textarea>
                            <div class="clearfix"></div>
                        </div>
                        <div class="mail-body text-right tooltip-demo">
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-reply"></i> Send</button>
                            <a href="{{route('business.sale.show',['portal'=>$institution->portal,'id'=>$sale->id])}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
    {{--                        <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>--}}
                        </div>
                    </form>

                    <div class="clearfix"></div>



                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <div class="row">
                            <h3 class="text-center">Sale Summary</h3>
                            <div class="col-sm-6">
                                <h5>From:</h5>
                                <address>
                                    <strong>{{$institution->name}}</strong><br>
                                    {{$institution->address->address_line_1}}<br>
                                    {{$institution->address->town}}, {{$institution->address->street}}<br>
                                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}<br>
                                    <abbr title="Email">E:</abbr> {{$institution->email}}
                                </address>
                            </div>

                            <div class="col-sm-6 text-right">
                                <h4>Sale No.</h4>
                                <h4 class="text-navy">{{$sale->reference}}</h4>
                                @if(isset($sale->contact))
                                    <span>To:</span>
                                    <address>
                                        <strong>{{$sale->contact->last_name}} {{$sale->contact->first_name}}</strong><br>
                                        <abbr title="Phone">P:</abbr> {{$sale->contact->phone_number}}<br>
                                        <abbr title="Email">E:</abbr> {{$sale->contact->email}}
                                    </address>
                                @endif
                                {{-- <address>
                                    <strong>Corporate, Inc.</strong><br>
                                    112 Street Avenu, 1080<br>
                                    Miami, CT 445611<br>
                                    <abbr title="Phone">P:</abbr> (120) 9000-4321
                                </address> --}}
                                <p>
                                    <span><strong>Invoice Date:</strong> {{$sale->date}} </span><br/>
                                    <span><strong>Due Date:</strong> {{$sale->due_date}} </span>
                                </p>
                            </div>
                        </div>

                        <div class="table-responsive m-t">
                            <table class="table invoice-table">
                                <thead>
                                <tr>
                                    <th>Item List</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->saleProducts as $product)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>
                                                    {{$product->product->name}}
                                                </strong>
                                            </div>
                                            {{--                                            <small>{!!$product->product->description!!}</small>--}}
                                        </td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->rate}}</td>
                                        <td>{{$product->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /table-responsive -->

                        <table class="table invoice-total">
                            <tbody>
                            <tr>
                                <td><strong>Sub Total :</strong></td>
                                <td>{{$sale->subtotal}}</td>
                            </tr>
                            <tr>
                                <td><strong>TAX :</strong></td>
                                <td>{{$sale->tax}}</td>
                            </tr>
                            <tr>
                                <td><strong>Discount :</strong></td>
                                <td>{{$sale->discount}}</td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td>{{$sale->total}}</td>
                            </tr>
                            </tbody>
                        </table>
                        {{-- <div class="text-right">
                            <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                        </div> --}}

                        <div class="well m-t"><strong>Notes</strong>
                            {{$sale->customer_notes}}
                        </div>

                        <div class="well m-t"><strong>Terms and Conditions</strong>
                            {{$sale->terms_and_conditions}}
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
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<!-- SUMMERNOTE -->
<script src="{{ asset('inspinia') }}/js/plugins/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function(){

        $('.summernote').summernote();

    });
</script>

@endsection
