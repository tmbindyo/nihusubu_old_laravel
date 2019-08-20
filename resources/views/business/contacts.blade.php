@extends('business.layouts.app')

@section('title', ' Contacts')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Contacts</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.sales')}}">Sales</a>
                </li>
                <li class="active">
                    <strong>Contacts</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="#" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
            </div>
        </div>
    </div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg">


                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg">


                    <h3 class="m-b-xs"><strong>Alex Johnatan</strong></h3>

                    <div class="font-bold">CEO</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg">


                    <h3 class="m-b-xs"><strong>Monica Smith</strong></h3>

                    <div class="font-bold">Marketing manager</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg">


                    <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                    <div class="font-bold">Sales manager</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg">


                    <h3 class="m-b-xs"><strong>Sandra Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a6.jpg">


                    <h3 class="m-b-xs"><strong>Janet Carton</strong></h3>

                    <div class="font-bold">CFO</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg">


                    <h3 class="m-b-xs"><strong>Alex Johnatan</strong></h3>

                    <div class="font-bold">CEO</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a7.jpg">


                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg">


                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg">


                    <h3 class="m-b-xs"><strong>Alex Johnatan</strong></h3>

                    <div class="font-bold">CEO</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg">


                    <h3 class="m-b-xs"><strong>Monica Smith</strong></h3>

                    <div class="font-bold">Marketing manager</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg">


                    <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                    <div class="font-bold">Sales manager</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
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
