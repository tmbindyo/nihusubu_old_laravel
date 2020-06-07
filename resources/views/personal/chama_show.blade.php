@extends('personal.layouts.app')

@section('title', 'Chama '.$chama->name)

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


@endsection


@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Chama's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li>
                    CRM
                </li>
                <li class="active">
                    <a href="{{route('personal.chamas')}}">Chama's</a>
                </li>
                <li class="active">
                    <strong>Chama Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Chama Registration <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form method="post" action="{{ route('personal.chama.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            <input type="number" id="shares" oninput="getShaveValue();" name="shares" required="required" value="1" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Member shares">
                                            <i>the amount of shares that you hold(this will not credit the chama account and thus should be currently held shares)</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            <input type="number" id="share_price" oninput="getShaveValue();" value="{{$chama->share_price}}" name="share_price" required="required" value="1" class="form-control input-lg">
                                            <i>share price</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            <input type="number" id="share_value" name="share_value" value="{{$chama->share_price}}" required="required" value="0" class="form-control input-lg" readonly>
                                            <i>share value</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            <input type="text" id="name" name="name" value="{{$chama->name}}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Name">
                                            <i>name</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            <input type="number" id="interest" value="{{$chama->interest}}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Interest">
                                            <i>member loan interest rate</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            <textarea id="description" rows="5" name="description" class="resizable_textarea form-control input-lg" required="required" >{{$chama->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <br>
                                    <hr>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Update') }}</button>
                                    </div>
                                </div>


                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row  text-center">
                                <a href="{{route('personal.chama.accounts',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Accounts</i>
                                </a>
                                <a href="{{route('personal.chama.loans',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Loans</i>
                                </a>
                                <a href="{{route('personal.chama.meetings',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Meetings</i>
                                </a>
                                <a href="{{route('personal.chama.members',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Members</i>
                                </a>
                                {{--  <a href="{{route('personal.chama.merry.go.round',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Merry Go Round</i>
                                </a>  --}}
                                <a href="{{route('personal.chama.penalties',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Penalties</i>
                                </a>
                                <a href="{{route('personal.chama.share.payments',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Shares</i>
                                </a>
                                <a href="{{route('personal.chama.welfares',$chama->id)}}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-eye"> Welfare</i>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        {{--  <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>
                                        <h2>Contract with Zender Company</h2>  --}}
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label label-primary">{{$chama->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$chama->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$chama->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> 	{{$chama->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#accounts" data-toggle="tab">Account</a></li>
                                            <li class=""><a href="#loans" data-toggle="tab">Loans</a></li>
                                            <li class=""><a href="#meetings" data-toggle="tab">Meetings</a></li>
                                            <li class=""><a href="#members" data-toggle="tab">Members</a></li>
                                            <li class=""><a href="#penalties" data-toggle="tab">Penalties</a></li>
                                            <li class=""><a href="#share-payments" data-toggle="tab">Shares</a></li>
                                            <li class=""><a href="#welfare" data-toggle="tab">Welfare</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="accounts">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Balance</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaAccounts as $account)
                                                            <tr class="gradeX">
                                                                <td>{{$account->name}}</td>
                                                                <td>{{$account->balance}}</td>
                                                                <td>{{$account->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$account->status->label}}">{{$account->status->name}}</span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.account.show',['chama_id'=>$chama->id, 'account_id'=>$account->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($account->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.account.restore',['chama_id'=>$chama->id, 'account_id'=>$account->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.account.delete',['chama_id'=>$chama->id, 'account_id'=>$account->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Balance</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
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
                                                            <th>Principal</th>
                                                            <th>Interest</th>
                                                            <th>Total</th>
                                                            <th>Paid</th>
                                                            <th>Date</th>
                                                            <th>Due Date</th>
                                                            <th>Account</th>
                                                            <th>Contact</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaLoans as $loan)
                                                            <tr class="gradeX">
                                                                <td>
                                                                    {{$loan->reference}}
                                                                    <span><i data-toggle="tooltip" data-placement="right" title="{{$loan->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                                </td>
                                                                <td>{{$loan->principal}}</td>
                                                                <td>{{$loan->interest}}</td>
                                                                <td>{{$loan->total}}</td>
                                                                <td>{{$loan->paid}}</td>
                                                                <td>{{$loan->date}}</td>
                                                                <td>{{$loan->due_date}}</td>
                                                                <td>{{$loan->account->name}}</td>
                                                                <td>{{$loan->chamaMember->name}}</td>
                                                                <td>{{$loan->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$loan->status->label}}">{{$loan->status->name}}</span>
                                                                </td>

                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.loan.show', ['chama_id'=>$chama->id, 'loan_id'=>$loan->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($loan->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.loan.restore', ['chama_id'=>$chama->id, 'loan_id'=>$loan->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.loan.delete', ['chama_id'=>$chama->id, 'loan_id'=>$loan->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Reference</th>
                                                            <th>Principal</th>
                                                            <th>Interest</th>
                                                            <th>Total</th>
                                                            <th>Paid</th>
                                                            <th>Date</th>
                                                            <th>Due Date</th>
                                                            <th>Account</th>
                                                            <th>Contact</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="meetings">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Location</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaMeetings as $meeting)
                                                            <tr class="gradeX">
                                                                <td>{{$meeting->date}}</td>
                                                                <td>{{$meeting->location}}</td>
                                                                <td>{{$meeting->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$meeting->status->label}}">{{$meeting->status->name}}</span>
                                                                </td>

                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.meeting.show', ['chama_id'=>$chama->id, 'meeting_id'=>$meeting->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($meeting->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.meeting.restore', ['chama_id'=>$chama->id, 'meeting_id'=>$meeting->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.meeting.delete', ['chama_id'=>$chama->id, 'meeting_id'=>$meeting->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Location</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="members">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Account</th>
                                                            <th>Name</th>
                                                            <th>Phone number</th>
                                                            <th>Email</th>
                                                            <th>Registerer</th>
                                                            <th>Shares</th>
                                                            <th>Member Role</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaMembers as $member)
                                                            <tr class="gradeX">
                                                                <td>
                                                                    @if($member->is_user == 1)
                                                                        Nihusubu User
                                                                    @else
                                                                        Nihusubu User
                                                                    @endif
                                                                </td>
                                                                <td>{{$member->name}}</td>
                                                                <td>{{$member->phone_number}}</td>
                                                                <td>{{$member->email}}</td>
                                                                <td>{{$member->user->name}}</td>
                                                                <td>{{$member->shares}}</td>
                                                                <td>{{$member->chamaMemberRole->name}}</td>
                                                                <td>
                                                                    <span class="label {{$member->status->label}}">{{$member->status->name}}</span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.member.show', ['chama_id'=>$chama->id, 'member_id'=>$member->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        <a href="{{ route('personal.chama.member.delete', ['chama_id'=>$chama->id, 'member_id'=>$member->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Account</th>
                                                            <th>Name</th>
                                                            <th>Phone number</th>
                                                            <th>Email</th>
                                                            <th>Registerer</th>
                                                            <th>Shares</th>
                                                            <th>Member Role</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="penalties">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaPenalties as $penalty)
                                                            <tr class="gradeX">
                                                                <td>{{$penalty->amount}}</td>
                                                                <td>{{$penalty->date}}</td>
                                                                <td>{{$penalty->chamaMember->name}}</td>
                                                                <td>{{$penalty->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$penalty->status->label}}">{{$penalty->status->name}}</span>
                                                                </td>

                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.penalty.show', ['chama_id'=>$chama->id, 'penalty_id'=>$penalty->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($penalty->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.penalty.restore', ['chama_id'=>$chama->id, 'penalty_id'=>$penalty->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.penalty.delete', ['chama_id'=>$chama->id, 'penalty_id'=>$penalty->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="share-payments">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Shares</th>
                                                            <th>Amount</th>
                                                            <th>Value</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaSharePayments as $share)
                                                            <tr class="gradeX">
                                                                <td>{{$share->shares}}</td>
                                                                <td>{{$share->amount}}</td>
                                                                <td>{{$share->value}}</td>
                                                                <td>{{$share->date}}</td>
                                                                <td>{{$share->chamaMember->name}}</td>
                                                                <td>{{$share->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$share->status->label}}">{{$share->status->name}}</span>
                                                                </td>

                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.share.payment.show', ['chama_id'=>$chama->id, 'share_id'=>$share->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($share->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.share.payment.restore', ['chama_id'=>$chama->id, 'share_id'=>$share->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.share.payment.delete', ['chama_id'=>$chama->id, 'share_id'=>$share->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Shares</th>
                                                            <th>Amount</th>
                                                            <th>Value</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="welfare">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>Account</th>
                                                            <th>Welfare Type</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($chamaWelfares as $welfare)
                                                            <tr class="gradeX">
                                                                <td>{{$welfare->amount}}</td>
                                                                <td>{{$welfare->date}}</td>
                                                                <td>{{$welfare->chamaMember->name}}</td>
                                                                <td>{{$welfare->account->name}}</td>
                                                                <td>{{$welfare->welfareType->name}}</td>
                                                                <td>{{$welfare->user->name}}</td>
                                                                <td>
                                                                    <span class="label {{$welfare->status->label}}">{{$welfare->status->name}}</span>
                                                                </td>

                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('personal.chama.welfare.show', ['chama_id'=>$chama->id, 'welfare_id'=>$welfare->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                        @if($welfare->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                            <a href="{{ route('personal.chama.welfare.restore', ['chama_id'=>$chama->id, 'welfare_id'=>$welfare->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('personal.chama.welfare.delete', ['chama_id'=>$chama->id, 'welfare_id'=>$welfare->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Member</th>
                                                            <th>Account</th>
                                                            <th>Welfare Type</th>
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

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

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

    <script>

        function getShaveValue() {
            var shares = document.getElementById('shares').value;
            var share_price = document.getElementById('share_price').value;
            console.log(share_price);
            {{--  get share value  --}}
            var share_value = parseFloat(shares) * parseFloat(share_price);
            console.log(share_value);
            {{--  set share value  --}}
            document.getElementById("share_value").value = share_value;


        }

    </script>


    {{--  Data tables  --}}
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
            $(".select2_demo_member_role").select2({
                placeholder: "Select Member Role",
                allowClear: true
            });
            $(".select2_demo_organization").select2({
                placeholder: "Select Organization",
                allowClear: true
            });
            $(".select2_demo_contact_type").select2({
                placeholder: "Select Contact Type",
                allowClear: true
            });
            $(".select2_demo_lead_source").select2({
                placeholder: "Select Lead Source",
                allowClear: true
            });
            $(".select2_demo_campaign").select2({
                placeholder: "Select Campaign",
                allowClear: true
            });


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
