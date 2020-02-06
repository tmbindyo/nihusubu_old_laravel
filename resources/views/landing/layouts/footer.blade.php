<footer class="g-bg-color--dark">
    <!-- Links -->
    <div class="g-hor-divider__dashed--white-opacity-lightest">
        <div class="container g-padding-y-80--xs">
            <div class="row">
                <div class="col-sm-2 g-margin-b-20--xs g-margin-b-0--md">
                    <ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('landing')}}">Home</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('about')}}">About</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('services')}}">Services</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('contacts')}}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 g-margin-b-20--xs g-margin-b-0--md">
                    <ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
                        <li><a class="g-font-size-15--xs g-color--white-opacity" target="_blank" href="https://twitter.com/nihusubu">Twitter</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" target="_blank" href="https://facebook.com/nihusubu">Facebook</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" target="_blank" href="https://instagram.com/nihusubu">Instagram</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" target="_blank" href="https://youtube.com/nihusubu">YouTube</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 g-margin-b-40--xs g-margin-b-0--md">
                    <ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
                        {{--  <li><a class="g-font-size-15--xs g-color--white-opacity" href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=nihusubu">Subscribe to Our Newsletter</a></li>  --}}
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                        <li><a class="g-font-size-15--xs g-color--white-opacity" href="{{route('terms.and.condition')}}">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 s-footer__logo g-padding-y-50--xs g-padding-y-0--md">
                    <h3 class="g-font-size-18--xs g-color--white">Nihusubu</h3>
                    {{--  TODO Description--}}
                    <p class="g-color--white-opacity">Pending.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Links -->

    <!-- Copyright -->
    <div class="container g-padding-y-50--xs">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{route("landing")}}">
                    {{--  TODO Change logo  --}}
                    <img class="g-width-100--xs g-height-auto--xs" src="{{ asset('logo_transparent.png') }}" alt="Nihusubu">
                </a>
            </div>
            <div class="col-xs-6 g-text-right--xs">
                <p class="g-font-size-14--xs g-margin-b-0--xs g-color--white-opacity-light"><a href="https://nihusubu.com">Nihusubu</a> Powered by: <a href="https://www.fluidtechglobal.com/">fluidtechglobal.com</a></p>
            </div>
        </div>
    </div>
    <!-- End Copyright -->
</footer>
