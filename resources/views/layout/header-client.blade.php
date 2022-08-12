<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{ route('client.index') }}">Home</a>

                            </li>
                            <li><a href="{{ route('client.about') }}">About</a></li>
                            <li><a href="#">Pages</a>

                            </li>
                            <li><a href="{{ route('client.new') }}">News</a>

                            </li>
                            <li><a href="{{ route('client.contact') }}">Contact</a></li>
                            <li><a href="{{ route('client.shop') }}">Shop</a>
                              
                            </li>
                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart" href="{{route('client.cart')}}"><i class="fas fa-shopping-cart"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="#"><i
                                            class="fas fa-search"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="{{ route('logout') }}"><i
                                            class="fas fa-user"></i> {{ Auth::user()?Auth::user()->name :''}}</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>

                    <div class="mobile-menu">
                    </div>

                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>