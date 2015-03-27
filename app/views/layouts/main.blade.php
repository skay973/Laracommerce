<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Les doudous de Cricri @section('head-title') @show</title>
        <meta name="keywords" content="HTML5,CSS3,Template" />
        <meta name="description" content="" />
        <meta name="Author" content="Kevin BERIC [develdesign.net]" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />

        {{ HTML::style('assets/plugins/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('assets/css/font-awesome.css') }}
        {{ HTML::style('assets/plugins/owl-carousel/owl.carousel.css') }}
        {{ HTML::style('assets/plugins/owl-carousel/owl.theme.css') }}
        {{ HTML::style('assets/plugins/owl-carousel/owl.transitions.css') }}
        {{ HTML::style('assets/plugins/magnific-popup/magnific-popup.css') }}
        {{ HTML::style('assets/css/animate.css') }}
        {{ HTML::style('assets/css/superslides.css') }}

        {{ HTML::style('assets/plugins/rs-plugin/css/settings.css') }}

        {{ HTML::style('assets/css/essentials.css') }}
        {{ HTML::style('assets/css/layout.css') }}
        {{ HTML::style('assets/css/layout-responsive.css') }}
        {{ HTML::style('assets/css/shop.css') }}
        {{ HTML::style('assets/css/color_scheme/orange.css') }}
        {{ HTML::style('assets/css/custom.css') }}

        {{ HTML::style('assets/css/bootstrap-editable.css') }}

        @section('styles')
        @show

        {{ HTML::script('assets/plugins/modernizr.min.js') }}
    </head>
    <body data-background="{{ asset('assets/images/boxed_bg.jpg') }}" class="boxed">
        <header id="topNav">
            <div class="container">
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>

                <a class="logo" href="{{ URL::to('/') }}">
                    <img src="{{ asset('assets/images/logo_small.png') }}" alt="Les doudous de cricri" />
                </a>

                <div class="navbar-collapse nav-main-collapse collapse pull-right">
                    <nav class="nav-main mega-menu">
                        <ul class="nav nav-pills nav-main scroll-menu" id="topMain">
                            <li>
                                <a href="{{ URL::to('/') }}">
                                    Accueil </i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="{{ URL::to('store') }}">
                                    Boutique <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($catnav as $cat)
                                        <li>{{ HTML::link('/store/category/'.$cat->id, $cat->name) }}</li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                              <a href="{{ URL::to('blog') }}">
                                Blog </i>
                              </a>
                            </li>
                            <li>
                              <a href="{{ URL::to('selection') }}">
                                Ma sélection </i>
                              </a>
                            </li>
                            <li>
                              <a href="{{ Url::to('contact') }}">Contact</a>
                            </li>

                            <li class="search">
                                {{ Form::open(array('url'=>'store/search', 'method'=>'get', 'class' => 'input-group pull-right')) }}
                                {{ Form::text('keyword', null, array('placeholder'=>'Rechercher', 'class'=>'form-control')) }}
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary notransition"><i class="fa fa-search"></i></input>
                                </span>
                                {{ Form::close() }}
                            </li>

                            <li class="quick-cart">
                                {{ Form::open(array('url' => 'store/payment/invoice')) }}
                                <span class="badge pull-right">{{ Cart::totalUniqueItems() }}</span>

                                <div class="quick-cart-content">
                                    <p><i class="fa fa-warning"></i> You have {{ Cart::totalUniqueItems() }} products on your cart</p>

                                    @foreach(Cart::contents() as $product)
                                    <a class="item" href="shop-product-full-width.html">
                                        <img class="pull-left" src="{{ asset($product->image) }}" width="40" height="40" alt="quick cart" />
                                        <div class="inline-block">
                                            <span class="title">{{ $product->name }}</span>
                                            <span class="price">{{ $product->price }}</span>
                                        </div>
                                    </a>
                                    @endforeach

                                    <div class="row cart-footer">
                                        <div class="col-md-6 nopadding-right">
                                            <a href="{{ URL::to('store/cart') }}" class="btn btn-primary btn-xs fullwidth">VIEW CART</a>
                                        </div>
                                        <div class="col-md-6 nopadding-left">
                                            <input type="submit" value="CHECKOUT" class="btn btn-info btn-xs fullwidth">
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </li>

                            @if(Auth::check())
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle">
                                {{ Auth::user()->firstname }} <i class="fa fa-angle-down"></i>
                              </a>
                              <ul class="dropdown-menu">
                                @if(Auth::user()->admin == 1)
                                <li>{{ HTML::link('admin/categories', 'Gérer les categories') }}</li>
                                <li>{{ HTML::link('admin/products', 'Gérer les produits') }}</li>
                                <li>{{ HTML::link('admin/orders', 'Gérer les commandes') }}</li>
                                @else
                                <li>{{ HTML::link('user/account', 'Mon compte') }}</li>
                                <li>{{ HTML::link('user/orders', 'Mes commandes') }}</li>
                                @endif
                                <li>{{ HTML::link('user/signout', 'Deconnexion') }}</li>
                              </ul>
                            </li>
                            @else
                            <li id="signin" class="dropdown">
                              <a href="#" class="dropdown-toggle">
                                Connexion <i class="fa fa-angle-down"></i>
                              </a>
                              <ul class="dropdown-menu">
                                <li>{{ HTML::link('user/signin', 'Connexion') }}</li>
                                <li>{{ HTML::link('user/newaccount', 'Enregistrer') }}</li>
                              </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <span id="header_shadow"></span>

        <div id="wrapper">
            @yield('promo')

            @yield('page-title')

            @include('notifications')

            @yield('text-center')
            <div id="shop">
                @yield('content')
            </div>
        </div>

        <footer>
            <div class="footer-bar">
                <div class="container">
                    <span class="copyright">Copyright &copy; Les doudous de Cricri, Création et réalisation par <a href="http://develdesign.net" alt="Devel Design">Devel Design</a>.</span>
                    <a class="toTop" href="#topNav">RETOUR EN HAUT <i class="fa fa-arrow-circle-up"></i></a>
                </div>
            </div>

            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="column col-md-4">
                            <h3>CONTACT</h3>

                            <p class="contact-desc">
                              Passionné(e) de crochet ? Comme moi ! Entrons dans la ronde des crochets et partageons quelques brides ensemble. Plus on est de fous, plus on rit !
                            </p>

                            <address class="font-opensans">
                                <ul>
                                    <li class="footer-sprite address">
                                        13, rue Raoul Dinga<br />
                                        97354 Rémire-Montjoly<br />
                                        Guyane Française<br />
                                    </li>
                                    <li class="footer-sprite phone">
                                        Téléphone : +594 594 38 37 87<br />
                                        Mobile : +594 694 38 09 94<br />
                                    </li>
                                    <li class="footer-sprite email">
                                        <a href="mailto:christianeberic@gmail.com">christianeberic@gmail.com</a>
                                    </li>
                                </ul>
                            </address>
                        </div>

                        <div class="column logo col-md-4 text-center">
                            <div class="logo-content">
                                <img class="animate_fade_in" src="{{ asset('assets/images/logo_main.png') }}" width="200" alt="" />
                            </div>
                        </div>

                        <div class="column col-md-4 text-right">
                            <h3>PUBLICITE</h3>
                            <img class="img-responsive" src="{{ asset('assets/images/ads/infocom.jpg')}}" width="300" style="margin: auto;" alt="Infocom Guyane" />
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        {{ HTML::script('assets/plugins/jquery-2.0.3.min.js') }}
        {{ HTML::script('assets/plugins/jquery-ui.min.js') }}
        {{ HTML::script('assets/plugins/jquery.easing.1.3.js') }}
        {{ HTML::script('assets/plugins/jquery.cookie.js') }}
        {{ HTML::script('assets/plugins/jquery.appear.js') }}
        {{ HTML::script('assets/plugins/jquery.isotope.js') }}
        {{ HTML::script('assets/plugins/masonry.js') }}

        {{ HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('assets/js/bootstrap-editable.min.js') }}
        {{ HTML::script('assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}
        {{ HTML::script('assets/plugins/owl-carousel/owl.carousel.min.js') }}
        {{ HTML::script('assets/plugins/stellar/jquery.stellar.min.js') }}
        {{ HTML::script('assets/plugins/knob/js/jquery.knob.js') }}
        {{ HTML::script('assets/plugins/jquery.backstretch.min.js') }}
        {{ HTML::script('assets/plugins/superslides/dist/jquery.superslides.min.js') }}
        {{ HTML::script('assets/plugins/mediaelement/build/mediaelement-and-player.min.js') }}

        {{ HTML::script('assets/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}
        {{ HTML::script('assets/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}
        {{ HTML::script('assets/js/slider_revolution.js') }}

        {{ HTML::script('assets/js/scripts.js') }}

        @section('javascripts')
        @show

        <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
        <!--<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-XXXXX-X', 'domainname.com');
            ga('send', 'pageview');
        </script>
        -->
    </body>
</html>
