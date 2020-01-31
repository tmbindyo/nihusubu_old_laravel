@extends('personal.layouts.app')

@section('title', 'Account')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection



@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Account</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Accounting's</strong>
                </li>
                <li class="active">
                   <a href="{{route('personal.accounts')}}"><strong>Account's</strong></a>
                </li>
                <li class="active">
                    <strong>Account</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
                <a href="{{route('personal.account.adjustment.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Account Adjustment </a>
                <a href="{{route('personal.account.deposit.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Deposit </a>
                <a href="{{route('personal.account.liability.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Liability </a>
                <a href="{{route('personal.account.loan.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Loan </a>
                <a href="{{route('personal.account.withdrawal.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Withdrawal </a>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Account <small>edit</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <form method="post" action="{{ route('personal.account.update',$account->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="name" name="name" value="{{$account->name}}" class="form-control input-lg">
                                        </div>
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="number" name="balance" value="{{$account->balance}}" class="form-control input-lg" readonly>
                                        </div>
                                        <i>balance</i>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <textarea rows="5" name="notes" class="form-control input-lg" >{{$account->notes}}</textarea>
                                        </div>
                                        <i>notes</i>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-primary btn-block btn-lg m-t-n-xs" type="submit"><strong>Update</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4>Acount description</h4>
                    <p class="small">
                        {{$account->notes}}
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label {{$account->status->label}}">{{$account->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$account->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$account->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> {{$account->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#account-adjustments" data-toggle="tab">Account Adjustments</a></li>
                                            <li class=""><a href="#deposits" data-toggle="tab">Deposits</a></li>
                                            <li class=""><a href="#liabilities" data-toggle="tab">Liabilities</a></li>
                                            <li class=""><a href="#loans" data-toggle="tab">Loans</a></li>
                                            <li class=""><a href="#payments" data-toggle="tab">Payments</a></li>
                                            <li class=""><a href="#refunds" data-toggle="tab">Refunds</a></li>
                                            <li class=""><a href="#transactions" data-toggle="tab">Transactions</a></li>
                                            <li class=""><a href="#withdrawals" data-toggle="tab">Withdrawals</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                    <div class="tab-pane active" id="account-adjustments">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Initial</th>
                                                    <th>Subsequent</th>
                                                    <th>Date</th>
                                                    <th>Deposit</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($account->account_adjustments as $adjustments)
                                                        <tr class="gradeX">
                                                            <td>
                                                                {{$adjustments->reference}}
                                                                <span><i data-toggle="tooltip" data-placement="right" title="{{$adjustments->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                            </td>
                                                            <td>{{$adjustments->amount}}</td>
                                                            <td>{{$adjustments->initial_account_amount}}</td>
                                                            <td>{{$adjustments->subsequent_account_amount}}</td>
                                                            <td>{{$adjustments->date}}</td>
                                                            <td>
                                                                @if($adjustments->is_deposit == 1)
                                                                    <span class="label label-success">Deposit</span>
                                                                @else
                                                                    <span class="label label-success">Non Deposit</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$adjustments->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$adjustments->status->label}}">{{$adjustments->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @if($adjustments->status_id == "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")
                                                                        <a href="{{ route('personal.account.adjustment.delete',$adjustments->id) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                    @elseif($adjustments->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                        <a href="{{ route('personal.account.adjustment.restore',$adjustments->id) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Initial</th>
                                                    <th>Subsequent</th>
                                                    <th>Date</th>
                                                    <th>Deposit</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="deposits">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->deposits as $deposit)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$deposit->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$deposit->about}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$deposit->amount}}</td>
                                                        <td>{{$deposit->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$deposit->status->label}}">{{$deposit->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('personal.deposit.show',$deposit->id) }}" class="btn-white btn btn-xs">View</a>
                                                                @if($deposit->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                    <a href="{{ route('personal.deposit.restore',$deposit->id) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                @else
                                                                    <a href="{{ route('personal.deposit.delete',$deposit->id) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="liabilities">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Paid</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    <th>Contact</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->liabilities as $liability)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$liability->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$liability->about}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$liability->amount}}</td>
                                                        <td>{{$liability->paid}}</td>
                                                        <td>{{$liability->date}}</td>
                                                        <td>{{$liability->due_date}}</td>
                                                        <td>{{$liability->contact->first_name}} {{$liability->contact->last_name}}</td>
                                                        <td>{{$liability->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$liability->status->label}}">{{$liability->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('personal.liability.show',$liability->id) }}" class="btn-white btn btn-xs">View</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Paid</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    <th>Contact</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="loans">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Paid</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    <th>Contact</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->loans as $loan)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$loan->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$loan->about}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$loan->amount}}</td>
                                                        <td>{{$loan->paid}}</td>
                                                        <td>{{$loan->date}}</td>
                                                        <td>{{$loan->due_date}}</td>
                                                        <td>{{$loan->contact->first_name}} {{$loan->contact->last_name}}</td>
                                                        <td>{{$loan->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$loan->status->label}}">{{$loan->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('personal.loan.show',$loan->id) }}" class="btn-white btn btn-xs">View</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Paid</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    <th>Contact</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="payments">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Initial</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->payments as $payment)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$payment->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$payment->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$payment->date}}</td>
                                                        <td>{{$payment->initial_amount}}</td>
                                                        <td>{{$payment->amount}}</td>
                                                        <td>{{$payment->current_balance}}</td>
                                                        <td>{{$payment->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$payment->status->label}}">{{$payment->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            {{--                                todo check why route is album but id is album type--}}
                                                            <div class="btn-group">
                                                                @if($payment->is_order == 1)
                                                                    <a href="{{ route('personal.order.show',$payment->order_id) }}" class="btn-white btn btn-xs">View</a>
                                                                @elseif($payment->is_album == 1)
                                                                    @if($payment->album->album_type_id == "ca64a5e0-d39b-4f2c-a136-9c523d935ea4"))
                                                                        <a href="{{ route('personal.client.proof.show',$payment->album_id) }}" class="btn-white btn btn-xs">View</a>
                                                                    @elseif($payment->album->album_type_id == "6fdf4858-01ce-43ff-bbe6-827f09fa1cef"))
                                                                        <a href="{{ route('personal.personal.album.show',$payment->album_id) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endif
                                                                @elseif($payment->is_design == 1)
                                                                    <a href="{{ route('personal.design.show',$payment->design_id) }}" class="btn-white btn btn-xs">View</a>
                                                                @elseif($payment->is_project == 1)
                                                                    <a href="{{ route('personal.project.show',$payment->project_id) }}" class="btn-white btn btn-xs">View</a>
                                                                @elseif($payment->is_asset_action == 1)
                                                                    <a href="{{ route('personal.asset.action.show',$payment->asset_action_id) }}" class="btn-white btn btn-xs">View</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Initial</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="refunds">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->refunds as $refund)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$refund->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$refund->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$refund->amount}}</td>
                                                        <td>{{$refund->date}}</td>
                                                        <td>{{$refund->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$refund->status->label}}">{{$refund->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('personal.payment.show',$refund->payment_id) }}" class="btn-white btn btn-xs">View</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th width="13em">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transactions">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Reference</th>
                                                        <th>Amount</th>
                                                        <th>Initial</th>
                                                        <th>Subsequent</th>
                                                        <th>Date</th>
                                                        <th>User</th>
                                                        <th>Billed</th>
                                                        <th>Confirmed</th>
                                                        <th>Status</th>
                                                        <th width="13em">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($account->transactions as $transaction)
                                                        <tr class="gradeX">
                                                            <td>
                                                                {{$transaction->reference}}
                                                                <span><i data-toggle="tooltip" data-placement="right" title="{{$transaction->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                            </td>
                                                            <td>{{$transaction->amount}}</td>
                                                            <td>{{$transaction->initial_amount}}</td>
                                                            <td>{{$transaction->subsequent_amount}}</td>
                                                            <td>{{$transaction->date}}</td>
                                                            <td>{{$transaction->user->name}}</td>
                                                            <td>
                                                                @if($transaction->is_billed == 1)
                                                                    <span class="label label-success"> Billed </span>
                                                                @else
                                                                    <span class="label label-warning"> Not Billed </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($transaction->is_confirmed == 1)
                                                                    <span class="label label-success"> Confirmed </span>
                                                                @else
                                                                    <span class="label label-warning"> Not Confirmed </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('personal.expense.show',$transaction->expense_id) }}" class="btn-white btn btn-xs">View</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Reference</th>
                                                        <th>Amount</th>
                                                        <th>Initial</th>
                                                        <th>Subsequent</th>
                                                        <th>Date</th>
                                                        <th>User</th>
                                                        <th>Billed</th>
                                                        <th>Confirmed</th>
                                                        <th>Status</th>
                                                        <th width="13em">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="withdrawals">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($account->withdrawals as $withdrawal)
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$withdrawal->reference}}
                                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$withdrawal->about}}." class="fa fa-facebook-messenger"></i></span>
                                                        </td>
                                                        <td>{{$withdrawal->amount}}</td>
                                                        <td>{{$withdrawal->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$withdrawal->status->label}}">{{$withdrawal->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                <a href="{{ route('personal.withdrawal.show',$withdrawal->id) }}" class="btn-white btn btn-xs">View</a>
                                                                @if($withdrawal->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                    <a href="{{ route('personal.withdrawal.restore',$withdrawal->id) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                @else
                                                                    <a href="{{ route('personal.withdrawal.delete',$withdrawal->id) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Amount</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    To Do's    --}}
        <div class="row m-t-lg">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>To Do's</h5>
                        <div class="ibox-tools">
                            <a data-toggle="modal" data-target="#toDoRegistration" class="btn btn-success btn-round btn-outline"> <span class="fa fa-plus"></span> New</a>
                        </div>
                    </div>
                    <div class="">
                        <ul class="pending-to-do">
                            @foreach($pendingToDos as $pendingToDo)
                                <li>
                                    <div>
                                        <small>{{$pendingToDo->due_date}}</small>
                                        <h4>{{$pendingToDo->name}}</h4>
                                        <p>{{$pendingToDo->notes}}.</p>
                                        @if($pendingToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$pendingToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('personal.to.do.set.in.progress',$pendingToDo->id)}}"><i class="fa fa-arrow-circle-o-right "></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <ul class="in-progress-to-do">
                            @foreach($inProgressToDos as $inProgressToDo)
                                <li>
                                    <div>
                                        <small>{{$inProgressToDo->due_date}}</small>
                                        <h4>{{$inProgressToDo->name}}</h4>
                                        <p>{{$inProgressToDo->notes}}.</p>
                                        @if($inProgressToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$inProgressToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('personal.to.do.set.completed',$inProgressToDo->id)}}"><i class="fa fa-check "></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="overdue-to-do">
                            @foreach($overdueToDos as $overdueToDo)
                                <li>
                                    <div>
                                        <small>{{$overdueToDo->due_date}}</small>
                                        <h4>{{$overdueToDo->name}}</h4>
                                        <p>{{$overdueToDo->notes}}.</p>
                                        @if($overdueToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$overdueToDo->design->name}}</span></p>
                                        @endif
                                        @if($overdueToDo->status->name === "Pending")
                                            <a href="{{route('personal.to.do.set.completed',$overdueToDo->id)}}"><i class="fa fa-check-double "></i></a>
                                        @elseif($overdueToDo->status->name === "In progress")
                                            <a href="{{route('personal.to.do.set.completed',$overdueToDo->id)}}"><i class="fa fa-check-double "></i></a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="completed-to-do">
                            @foreach($completedToDos as $completedToDo)
                                <li>
                                    <div>
                                        <small>{{$completedToDo->due_date}}</small>
                                        <h4>{{$completedToDo->name}}</h4>
                                        <p>{{$completedToDo->notes}}.</p>
                                        @if($completedToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$completedToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('personal.to.do.delete',$completedToDo->id)}}"><i class="fa fa-trash-o "></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@include('personal.layouts.modals.account_to_do')

@section('js')


    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

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

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

<!-- TouchSpin -->
<script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>


{{--  Get due date to populate   --}}
<script>
    $(document).ready(function() {
        // Set date
        console.log('var');
        var today = new Date();
        console.log(today);
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        mm ++;
        if (dd < 10){
            dd = '0'+dd;
        }
        if (mm < 10){
            mm = '0'+mm;
        }
        var date_today = mm + '/' + dd + '/' + yyyy;
        var time_curr = h + ':' + m;
        console.log(time_curr);
        document.getElementById("start_date").value = date_today;
        document.getElementById("end_date").value = date_today;
        document.getElementById("start_time").value = time_curr;
        document.getElementById("end_time").value = time_curr;

        // Set time
    });

</script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


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

            var elem_18 = document.querySelector('.js-switch_18');
            var switchery_18 = new Switchery(elem_18, { color: '#1AB394' });

            var elem_19 = document.querySelector('.js-switch_19');
            var switchery_19 = new Switchery(elem_19, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });

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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_tag").select2({
                placeholder: "Select Tags",
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
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

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

        $("#basic_slider").noUiSlider({
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
        });


    </script>

@endsection
