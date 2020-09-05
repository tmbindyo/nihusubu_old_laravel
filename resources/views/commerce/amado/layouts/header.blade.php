<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="{{route('commerce.index',$institution->portal)}}"><img src="{{ asset('e_commerce/amado') }}/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="{{ Route::currentRouteNamed( 'commerce.index',$institution->portal ) ?  'active' : '' }}"><a href="{{route('commerce.index',$institution->portal)}}">Home</a></li>
            <li class="{{ Route::currentRouteNamed( 'commerce.shop',$institution->portal ) ?  'active' : '' }}"><a href="{{route('commerce.shop',$institution->portal)}}">Shop</a></li>
            <li class="{{ Route::currentRouteNamed( 'commerce.cart',$institution->portal ) ?  'active' : '' }}"><a href="{{route('commerce.cart',$institution->portal)}}">Cart</a></li>
            <li class="{{ Route::currentRouteNamed( 'commerce.checkout',$institution->portal ) ?  'active' : '' }}"><a href="{{route('commerce.checkout',$institution->portal)}}">Checkout</a></li>
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">%Discount%</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{route('commerce.cart',$institution->portal)}}" class="cart-nav"><img src="{{ asset('e_commerce/amado') }}/img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
        <a href="#" class="fav-nav"><img src="{{ asset('e_commerce/amado') }}/img/core-img/favorites.png" alt=""> Favourite</a>
        <a href="#" class="search-nav"><img src="{{ asset('e_commerce/amado') }}/img/core-img/search.png" alt=""> Search</a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        @if($institution->instagram)
            <a target="_blank" href="http://instagram.com/{{$institution->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        @endif
        @if($institution->facebook)
            <a target="_blank" href="http://facebook.com/{{$institution->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        @if($institution->twitter)
        @endif
            <a target="_blank" href="http://twitter.com/{{$institution->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        @endif
    </div>
</header>
