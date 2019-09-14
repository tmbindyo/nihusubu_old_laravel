@extends('personal.layouts.app')

@section('title', 'Dashboard')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('inspinia') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('inspinia') }}/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">



@endsection
@section('content')

{{--    Heading  --}}
<div class="row  border-bottom white-bg dashboard-header">

    <div class="col-sm-3">
        <h2>Welcome Amelia</h2>
        <small>You have 42 messages and 6 notifications.</small>
        <ul class="list-group clear-list m-t">
            <li class="list-group-item fist-item">
                                <span class="pull-right">
                                    09:00 pm
                                </span>
                <span class="label label-success">1</span> Please contact me
            </li>
            <li class="list-group-item">
                                <span class="pull-right">
                                    10:16 am
                                </span>
                <span class="label label-info">2</span> Sign a contract
            </li>
            <li class="list-group-item">
                                <span class="pull-right">
                                    08:22 pm
                                </span>
                <span class="label label-primary">3</span> Open new shop
            </li>
            <li class="list-group-item">
                                <span class="pull-right">
                                    11:06 pm
                                </span>
                <span class="label label-default">4</span> Call back to Sylvia
            </li>
            <li class="list-group-item">
                                <span class="pull-right">
                                    12:00 am
                                </span>
                <span class="label label-primary">5</span> Write a letter to Sandra
            </li>
        </ul>
    </div>
    <div class="col-sm-6">
        <div class="flot-chart dashboard-chart">
            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
        </div>
        <div class="row text-left">
            <div class="col-xs-4">
                <div class=" m-l-md">
                    <span class="h4 font-bold m-t block">$ 406,100</span>
                    <small class="text-muted m-b block">Sales marketing report</small>
                </div>
            </div>
            <div class="col-xs-4">
                <span class="h4 font-bold m-t block">$ 150,401</span>
                <small class="text-muted m-b block">Annual sales revenue</small>
            </div>
            <div class="col-xs-4">
                <span class="h4 font-bold m-t block">$ 16,822</span>
                <small class="text-muted m-b block">Half-year revenue margin</small>
            </div>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="statistic-box">
            <h4>
                Project Beta progress
            </h4>
            <p>
                You have two project with not compleated task.
            </p>
            <div class="row text-center">
                <div class="col-lg-6">
                    <canvas id="polarChart" width="80" height="80"></canvas>
                    <h5 >Kolter</h5>
                </div>
                <div class="col-lg-6">
                    <canvas id="doughnutChart" width="78" height="78"></canvas>
                    <h5 >Maxtor</h5>
                </div>
            </div>
            <div class="m-t">
                <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>

        </div>
    </div>

</div>

{{--    Dashboard 1--}}
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New data for the report</h5> <span class="label label-primary">IN+</span>
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
                    <div>

                        <div class="pull-right text-right">

                            <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                            <br/>
                            <small class="font-bold">$ 20 054.43</small>
                        </div>
                        <h4>NYS report new data!
                            <br/>
                            <small class="m-r"><a href="graph_flot.html"> Check the stock price! </a> </small>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Read below comments</h5>
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
                <div class="ibox-content no-padding">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Stock Man</a> Check this stock chart. This price is crazy! </p>
                            <div class="text-center m">
                                <span id="sparkline8"></span>
                            </div>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                        </li>
                        <li class="list-group-item ">
                            <p><a class="text-info" href="#">@Jonathan Febrick</a> The standard chunk of Lorem Ipsum</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Your daily feed</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light pull-right">10 Messages</span>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">

                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">5m ago</small>
                                    <strong>Monica Smith</strong> posted a new blog. <br>
                                    <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                </div>
                            </div>

                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">2h ago</small>
                                    <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                    <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">2h ago</small>
                                    <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 8:30am</small>
                                </div>
                            </div>
                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                        <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                    </div>
                                </div>
                            </div>
                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">2h ago</small>
                                    <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                    <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                    <div class="well">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                    </div>
                                </div>
                            </div>
                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                            <div class="feed-element">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a7.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Alpha project</h5>
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
                <div class="ibox-content ibox-heading">
                    <h3>You have meeting today!</h3>
                    <small><i class="fa fa-map-marker"></i> Meeting is on 6:00am. Check your schedule to see detail.</small>
                </div>
                <div class="ibox-content inspinia-timeline">

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                6:00 am
                                <br/>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Meeting</strong></p>

                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the
                                    sale.</p>

                                <p><span data-diameter="40" class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,4,7,3,2,9,8,7,4,5,1,2,9,5,4,7,2,7,7,3,5,2</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-file-text"></i>
                                7:00 am
                                <br/>
                                <small class="text-navy">3 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-coffee"></i>
                                8:00 am
                                <br/>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                <p>
                                    Go to shop and find some products.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-phone"></i>
                                11:00 am
                                <br/>
                                <small class="text-navy">21 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                <p>
                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-user-md"></i>
                                09:00 pm
                                <br/>
                                <small>21 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Go to the doctor dr Smith</strong></p>
                                <p>
                                    Find some issue and go to doctor.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-comments"></i>
                                12:50 pm
                                <br/>
                                <small class="text-navy">48 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Chat with Monica and Sandra</strong></p>
                                <p>
                                    Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


{{--    Dashboard 2--}}
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Monthly</span>
                    <h5>Income</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">40 886,200</h1>
                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                    <small>Total income</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Annual</span>
                    <h5>Orders</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>New orders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Today</span>
                    <h5>Vistits</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                    <small>New visits</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Low value</span>
                    <h5>User activity</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                    <small>In first month</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Messages</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ibox-heading">
                    <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                    <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">

                        <div class="feed-element">
                            <div>
                                <small class="pull-right text-navy">1m ago</small>
                                <strong>Monica Smith</strong>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">2m ago</small>
                                <strong>Jogn Angel</strong>
                                <div>There are many variations of passages of Lorem Ipsum available</div>
                                <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Jesica Ocean</strong>
                                <div>Contrary to popular belief, Lorem Ipsum</div>
                                <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Monica Jackson</strong>
                                <div>The generated Lorem Ipsum is therefore </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>


                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Anna Legend</strong>
                                <div>All the Lorem Ipsum generators on the Internet tend to repeat </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Damian Nowak</strong>
                                <div>The standard chunk of Lorem Ipsum used </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Gary Smith</strong>
                                <div>200 Latin words, combined with a handful</div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>User project list</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><small>Pending...</small></td>
                                    <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                    <td>Samantha</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                </tr>
                                <tr>
                                    <td><span class="label label-warning">Canceled</span> </td>
                                    <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                    <td>Monica</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                </tr>
                                <tr>
                                    <td><small>Pending...</small> </td>
                                    <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                    <td>John</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                </tr>
                                <tr>
                                    <td><small>Pending...</small> </td>
                                    <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                    <td>Agnes</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                </tr>
                                <tr>
                                    <td><small>Pending...</small> </td>
                                    <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                    <td>Janet</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                </tr>
                                <tr>
                                    <td><span class="label label-primary">Completed</span> </td>
                                    <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                    <td>Amelia</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                </tr>
                                <tr>
                                    <td><small>Pending...</small> </td>
                                    <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                    <td>Damian</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Small todo list</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <ul class="todo-list m-t small-list">
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                    <span class="m-l-xs todo-completed">Buy a milk</span>

                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Go to shop and find some products.</span>

                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Send documents to Mike</span>
                                    <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Go to the doctor dr Smith</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                    <span class="m-l-xs todo-completed">Plan vacation</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Create new stuff</span>
                                </li>
                                <li>
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Call to Anna for dinner</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Transactions worldwide</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%" class="text-center">No.</th>
                                            <th>Transaction</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td> Security doors
                                            </td>
                                            <td class="text-center small">16 Jun 2014</td>
                                            <td class="text-center"><span class="label label-primary">$483.00</span></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td> Wardrobes
                                            </td>
                                            <td class="text-center small">10 Jun 2014</td>
                                            <td class="text-center"><span class="label label-primary">$327.00</span></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td> Set of tools
                                            </td>
                                            <td class="text-center small">12 Jun 2014</td>
                                            <td class="text-center"><span class="label label-warning">$125.00</span></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td> Panoramic pictures</td>
                                            <td class="text-center small">22 Jun 2013</td>
                                            <td class="text-center"><span class="label label-primary">$344.00</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Phones</td>
                                            <td class="text-center small">24 Jun 2013</td>
                                            <td class="text-center"><span class="label label-primary">$235.00</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td>Monitors</td>
                                            <td class="text-center small">26 Jun 2013</td>
                                            <td class="text-center"><span class="label label-primary">$100.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <div id="world-map" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

{{--    Dashboard 3--}}
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                            <br/>
                                            All sales: 162,862
                                        </span>
                        <h1 class="m-b-xs">$ 50,992</h1>
                        <h3 class="font-bold no-margins">
                            Half-year revenue margin
                        </h3>
                        <small>Sales marketing.</small>
                    </div>

                    <div>
                        <canvas id="lineChart" height="70"></canvas>
                    </div>

                    <div class="m-t-md">
                        <small class="pull-right">
                            <i class="fa fa-clock-o"> </i>
                            Update on 16.07.2015
                        </small>
                        <small>
                            <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Today</span>
                    <h5>Vistits</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">22 285,400</h1>
                    <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
                    <small>New orders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Monthly</span>
                    <h5>Orders</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">60 420,600</h1>
                    <div class="stat-percent font-bold text-info">40% <i class="fa fa-level-up"></i></div>
                    <small>New orders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">Annual</span>
                    <h5>Income</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">$ 120 430,800</h1>
                    <div class="stat-percent font-bold text-warning">16% <i class="fa fa-level-up"></i></div>
                    <small>New orders</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New data for the report</h5>
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
                <div class="ibox-content ibox-heading">
                    <h3>Stock price up
                        <div class="stat-percent text-navy">34% <i class="fa fa-level-up"></i></div>
                    </h3>
                    <small><i class="fa fa-stack-exchange"></i> New economic data from the previous quarter.</small>
                </div>
                <div class="ibox-content">
                    <div>

                        <div class="pull-right text-right">

                            <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                            <br/>
                            <small class="font-bold">$ 20 054.43</small>
                        </div>
                        <h4>NYS report new data!
                            <br/>
                            <small class="m-r"><a href="graph_flot.html"> Check the stock price! </a> </small>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Read below comments and tweets</h5>
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
                <div class="ibox-content no-padding">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Stock Man</a> Check this stock chart. This price is crazy! </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                        </li>
                        <li class="list-group-item">
                            <p><a class="text-info" href="#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                        </li>
                        <li class="list-group-item ">
                            <p><a class="text-info" href="#">@Jonathan Febrick</a> The standard chunk of Lorem Ipsum</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Timeline</h5>
                    <span class="label label-primary">Meeting today</span>
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

                <div class="ibox-content inspinia-timeline">

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                6:00 am
                                <br/>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Meeting</strong></p>

                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products.</p>

                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-file-text"></i>
                                7:00 am
                                <br/>
                                <small class="text-navy">3 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-coffee"></i>
                                8:00 am
                                <br/>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                <p>
                                    Go to shop and find some products.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-phone"></i>
                                11:00 am
                                <br/>
                                <small class="text-navy">21 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                <p>
                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{--    Dashboard 4--}}
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Monthly</span>
                    <h5>Views</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">386,200</h1>
                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                    <small>Total views</small>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Annual</span>
                    <h5>Orders</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,800</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>New orders</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Today</span>
                    <h5>Vistits</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="no-margins">406,42</h1>
                            <div class="font-bold text-navy">44% <i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="no-margins">206,12</h1>
                            <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Monthly income</h5>
                    <div class="ibox-tools">
                        <span class="label label-primary">Updated 12.2015</span>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="flot-chart m-t-lg" style="height: 55px;">
                        <div class="flot-chart-content" id="flot-chart1"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                            <br/>
                                            All sales: 162,862
                                        </span>
                        <h3 class="font-bold no-margins">
                            Half-year revenue margin
                        </h3>
                        <small>Sales marketing.</small>
                    </div>

                    <div class="m-t-sm">

                        <div class="row">
                            <div class="col-md-8">
                                <div>
                                    <canvas id="lineChart" height="114"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="stat-list m-t-lg">
                                    <li>
                                        <h2 class="no-margins">2,346</h2>
                                        <small>Total orders in period</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 48%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">4,422</h2>
                                        <small>Orders in last month</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 60%;"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="m-t-md">
                        <small class="pull-right">
                            <i class="fa fa-clock-o"> </i>
                            Update on 16.07.2015
                        </small>
                        <small>
                            <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                        </small>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">Data has changed</span>
                    <h5>User activity</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>236 321.80</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>46.11%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>432.021</h4>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>643 321.10</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>92.43%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>564.554</h4>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-4">
                            <small class="stats-label">Pages / Visit</small>
                            <h4>436 547.20</h4>
                        </div>

                        <div class="col-xs-4">
                            <small class="stats-label">% New Visits</small>
                            <h4>150.23%</h4>
                        </div>
                        <div class="col-xs-4">
                            <small class="stats-label">Last week</small>
                            <h4>124.990</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Custom responsive table </h5>
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
                        <div class="col-sm-9 m-b-xs">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Project </th>
                                <th>Name </th>
                                <th>Phone </th>
                                <th>Company </th>
                                <th>Completed </th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Project <small>This is example of project</small></td>
                                <td>Patrick Smith</td>
                                <td>0800 051213</td>
                                <td>Inceptos Hymenaeos Ltd</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>20%</td>
                                <td>Jul 14, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Alpha project</td>
                                <td>Alice Jackson</td>
                                <td>0500 780909</td>
                                <td>Nec Euismod In Company</td>
                                <td><span class="pie">6,9</span></td>
                                <td>40%</td>
                                <td>Jul 16, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Betha project</td>
                                <td>John Smith</td>
                                <td>0800 1111</td>
                                <td>Erat Volutpat</td>
                                <td><span class="pie">3,1</span></td>
                                <td>75%</td>
                                <td>Jul 18, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gamma project</td>
                                <td>Anna Jordan</td>
                                <td>(016977) 0648</td>
                                <td>Tellus Ltd</td>
                                <td><span class="pie">4,9</span></td>
                                <td>18%</td>
                                <td>Jul 22, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Alpha project</td>
                                <td>Alice Jackson</td>
                                <td>0500 780909</td>
                                <td>Nec Euismod In Company</td>
                                <td><span class="pie">6,9</span></td>
                                <td>40%</td>
                                <td>Jul 16, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Project <small>This is example of project</small></td>
                                <td>Patrick Smith</td>
                                <td>0800 051213</td>
                                <td>Inceptos Hymenaeos Ltd</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>20%</td>
                                <td>Jul 14, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gamma project</td>
                                <td>Anna Jordan</td>
                                <td>(016977) 0648</td>
                                <td>Tellus Ltd</td>
                                <td><span class="pie">4,9</span></td>
                                <td>18%</td>
                                <td>Jul 22, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Project <small>This is example of project</small></td>
                                <td>Patrick Smith</td>
                                <td>0800 051213</td>
                                <td>Inceptos Hymenaeos Ltd</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>20%</td>
                                <td>Jul 14, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Alpha project</td>
                                <td>Alice Jackson</td>
                                <td>0500 780909</td>
                                <td>Nec Euismod In Company</td>
                                <td><span class="pie">6,9</span></td>
                                <td>40%</td>
                                <td>Jul 16, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Betha project</td>
                                <td>John Smith</td>
                                <td>0800 1111</td>
                                <td>Erat Volutpat</td>
                                <td><span class="pie">3,1</span></td>
                                <td>75%</td>
                                <td>Jul 18, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gamma project</td>
                                <td>Anna Jordan</td>
                                <td>(016977) 0648</td>
                                <td>Tellus Ltd</td>
                                <td><span class="pie">4,9</span></td>
                                <td>18%</td>
                                <td>Jul 22, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Alpha project</td>
                                <td>Alice Jackson</td>
                                <td>0500 780909</td>
                                <td>Nec Euismod In Company</td>
                                <td><span class="pie">6,9</span></td>
                                <td>40%</td>
                                <td>Jul 16, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Project <small>This is example of project</small></td>
                                <td>Patrick Smith</td>
                                <td>0800 051213</td>
                                <td>Inceptos Hymenaeos Ltd</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>20%</td>
                                <td>Jul 14, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gamma project</td>
                                <td>Anna Jordan</td>
                                <td>(016977) 0648</td>
                                <td>Tellus Ltd</td>
                                <td><span class="pie">4,9</span></td>
                                <td>18%</td>
                                <td>Jul 22, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>

{{--    Dashboard 5   --}}
<div class="wrapper wrapper-content animated fadeIn">

    <div class="p-w-md m-t-sm">
        <div class="row">

            <div class="col-sm-4">
                <h1 class="m-b-xs">
                    26,900
                </h1>
                <small>
                    Sales in current month
                </small>
                <div id="sparkline1" class="m-b-sm"></div>
                <div class="row">
                    <div class="col-xs-4">
                        <small class="stats-label">Pages / Visit</small>
                        <h4>236 321.80</h4>
                    </div>

                    <div class="col-xs-4">
                        <small class="stats-label">% New Visits</small>
                        <h4>46.11%</h4>
                    </div>
                    <div class="col-xs-4">
                        <small class="stats-label">Last week</small>
                        <h4>432.021</h4>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <h1 class="m-b-xs">
                    98,100
                </h1>
                <small>
                    Sales in last 24h
                </small>
                <div id="sparkline2" class="m-b-sm"></div>
                <div class="row">
                    <div class="col-xs-4">
                        <small class="stats-label">Pages / Visit</small>
                        <h4>166 781.80</h4>
                    </div>

                    <div class="col-xs-4">
                        <small class="stats-label">% New Visits</small>
                        <h4>22.45%</h4>
                    </div>
                    <div class="col-xs-4">
                        <small class="stats-label">Last week</small>
                        <h4>862.044</h4>
                    </div>
                </div>


            </div>
            <div class="col-sm-4">

                <div class="row m-t-xs">
                    <div class="col-xs-6">
                        <h5 class="m-b-xs">Income last month</h5>
                        <h1 class="no-margins">160,000</h1>
                        <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                    </div>
                    <div class="col-xs-6">
                        <h5 class="m-b-xs">Sals current year</h5>
                        <h1 class="no-margins">42,120</h1>
                        <div class="font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                    </div>
                </div>


                <table class="table small m-t-sm">
                    <tbody>
                    <tr>
                        <td>
                            <strong>142</strong> Projects

                        </td>
                        <td>
                            <strong>22</strong> Messages
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <strong>61</strong> Comments
                        </td>
                        <td>
                            <strong>54</strong> Articles
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>154</strong> Companies
                        </td>
                        <td>
                            <strong>32</strong> Clients
                        </td>
                    </tr>
                    </tbody>
                </table>



            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="small pull-left col-md-3 m-l-lg m-t-md">
                    <strong>Sales char</strong> have evolved over the years sometimes.
                </div>
                <div class="small pull-right col-md-3 m-t-md text-right">
                    <strong>There are many</strong> variations of passages of Lorem Ipsum available, but the majority have suffered.
                </div>
                <div class="flot-chart m-b-xl">
                    <div class="flot-chart-content" id="flot-dashboard5-chart"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">



                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="product_name">Project Name</label>
                                    <input type="text" id="product_name" name="product_name" value="" placeholder="Project Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="price">Name</label>
                                    <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Company</label>
                                    <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected="">Completed</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">

                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Master project</td>
                                    <td>Patrick Smith</td>
                                    <td>$892,074</td>
                                    <td>Inceptos Hymenaeos Ltd</td>
                                    <td><strong>20%</strong></td>
                                    <td>Jul 14, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Alpha project</td>
                                    <td>Alice Jackson</td>
                                    <td>$963,486</td>
                                    <td>Nec Euismod In Company</td>
                                    <td><strong>40%</strong></td>
                                    <td>Jul 16, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Betha project</td>
                                    <td>John Smith</td>
                                    <td>$996,824</td>
                                    <td>Erat Volutpat</td>
                                    <td><strong>75%</strong></td>
                                    <td>Jul 18, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Gamma project</td>
                                    <td>Anna Jordan</td>
                                    <td>$105,192</td>
                                    <td>Tellus Ltd</td>
                                    <td><strong>18%</strong></td>
                                    <td>Jul 22, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Alpha project</td>
                                    <td>Alice Jackson</td>
                                    <td>$674,803</td>
                                    <td>Nec Euismod In Company</td>
                                    <td><strong>40%</strong></td>
                                    <td>Jul 16, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Master project</td>
                                    <td>Patrick Smith</td>
                                    <td>$174,729</td>
                                    <td>Inceptos Hymenaeos Ltd</td>
                                    <td><strong>20%</strong></td>
                                    <td>Jul 14, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Gamma project</td>
                                    <td>Anna Jordan</td>
                                    <td>$823,198</td>
                                    <td>Tellus Ltd</td>
                                    <td><strong>18%</strong></td>
                                    <td>Jul 22, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Project <small>This is example of project</small></td>
                                    <td>Patrick Smith</td>
                                    <td>$778,696</td>
                                    <td>Inceptos Hymenaeos Ltd</td>
                                    <td><strong>20%</strong></td>
                                    <td>Jul 14, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Alpha project</td>
                                    <td>Alice Jackson</td>
                                    <td>$861,063</td>
                                    <td>Nec Euismod In Company</td>
                                    <td><strong>40%</strong></td>
                                    <td>Jul 16, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Betha project</td>
                                    <td>John Smith</td>
                                    <td>$109,125</td>
                                    <td>Erat Volutpat</td>
                                    <td><strong>75%</strong></td>
                                    <td>Jul 18, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Gamma project</td>
                                    <td>Anna Jordan</td>
                                    <td>$600,978</td>
                                    <td>Tellus Ltd</td>
                                    <td><strong>18%</strong></td>
                                    <td>Jul 22, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Alpha project</td>
                                    <td>Alice Jackson</td>
                                    <td>$150,161</td>
                                    <td>Nec Euismod In Company</td>
                                    <td><strong>40%</strong></td>
                                    <td>Jul 16, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Project <small>This is example of project</small></td>
                                    <td>Patrick Smith</td>
                                    <td>$160,586</td>
                                    <td>Inceptos Hymenaeos Ltd</td>
                                    <td><strong>20%</strong></td>
                                    <td>Jul 14, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Gamma project</td>
                                    <td>Anna Jordan</td>
                                    <td>$110,612</td>
                                    <td>Tellus Ltd</td>
                                    <td><strong>18%</strong></td>
                                    <td>Jul 22, 2015</td>
                                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
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

    <!-- Flot -->
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/curvedLines.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="{{ asset('inspinia') }}/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('inspinia') }}/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="{{ asset('inspinia') }}/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- GITTER -->
    <script src="{{ asset('inspinia') }}/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="{{ asset('inspinia') }}/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('inspinia') }}/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="{{ asset('inspinia') }}/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="{{ asset('inspinia') }}/js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Welcome to NIHUSUBU');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });
    </script>

    <script>
        $(document).ready(function() {

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Example dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        });
    </script>

    <script>
        $(document).ready(function() {

            var sparklineCharts = function(){
                $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();




            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                    data1,  data2
                ],
                {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,

                        borderWidth: 2,
                        color: 'transparent'
                    },
                    colors: ["#1ab394", "#1C84C6"],
                    xaxis:{
                    },
                    yaxis: {
                    },
                    tooltip: false
                }
            );

        });
    </script>
@endsection
