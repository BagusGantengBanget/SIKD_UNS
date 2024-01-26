<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>
        @yield('title')
    </title>

    <!-- Favicons-->
    <link rel="icon" href="{{ asset('images\favicon\favicon-32x32.png') }}" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images\favicon\apple-touch-icon-152x152.png') }}">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->


    <!-- CORE CSS-->    
    <link href="{{ asset('css\materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('css\style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="{{ asset('css/custom/custom.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">


    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('js\plugins\perfect-scrollbar\perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('js\plugins\jvectormap\jquery-jvectormap.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('js\plugins\chartist-js\chartist.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    {{-- @yield('css-datatables') --}}
    {{-- <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet"> --}}
   
    

    
</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.htm" class="brand-logo darken-1"><img src="images\sieuns5.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                    {{-- <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
                    </div> --}}
                    <ul class="right hide-on-med-and-down">
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown"><img src="images\flag-icons\United-States.png" alt="USA"></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i>
                        
                        </a>
                        </li>                        
                        <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li>
                    </ul>
                    <!-- translation-button -->
                    <ul id="translation-dropdown" class="dropdown-content">
                      <li>
                        <a href="#!"><img src="images\flag-icons\United-States.png" alt="English">  <span class="language-select">English</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\France.png" alt="French">  <span class="language-select">French</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\China.png" alt="Chinese">  <span class="language-select">Chinese</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\Germany.png" alt="German">  <span class="language-select">German</span></a>
                      </li>
                      
                    </ul>
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class="new badge">5</span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#!"><i class="mdi-action-add-shopping-cart"></i> A new order has been placed!</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-stars"></i> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-settings"></i> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-editor-insert-invitation"></i> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-trending-up"></i> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                      </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details cyan darken-2">
                    <div class="row">
                        <div class="col col s4 m4 l4">
                            <img src="images\avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                        </div>
                        <div class="col col s8 m8 l8">
                            <ul id="profile-dropdown" class="dropdown-content">
                                <li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
                                </li>
                                <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                                </li>
                                <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                                </li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                            <p class="user-roal">Administrator</p>
                        </div>
                    </div>
                </li>
                </li>
                <li class="{{ 'home' == request()->path() ? 'active' : '' }}"><a href="/home" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Home</a>
                </li>
                <li class="{{ 'data_dosen' == request()->path() ? 'active' : '' }}"><a href="/data_dosen" class="waves-effect waves-cyan"><i class="mdi-social-people"></i> Data Dosen</a>
                </li>
                <li class="bold" >
                    <ul class="collapsible " data-collapsible="accordian"  >
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"  ><i class="mdi-action-view-carousel"></i> Data Kinerja</a>
                            <div class="collapsible-body">
                                <ul >
                                    <li class="{{ 'kinerja_buku' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_buku?keyword=2021">Kinerja Buku</a>
                                    </li>
                                    {{-- <li class="{{ 'kinerja_haki' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_haki">Kinerja Haki</a>
                                    </li> --}}
                                    <li class="{{ 'kinerja_hakipaten' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_hakipaten?keyword=&keyword=2021">Kinerja Haki Paten</a>
                                    </li>
                                    <li class="{{ 'kinerja_jurnal' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_jurnal?keyword=&keyword=2021">Kinerja Jurnal</a>
                                    </li>
                                    <li class="{{ 'kinerja_karyacipta' == request()->path() ? 'active' : '' }}">
                                        <a href="/kinerja_karyacipta?keyword=&keyword=2021">Kinerja Karya Cipta</a>
                                    </li>
                                    <li class="{{ 'kinerja_karyaseni' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_karyaseni?keyword=&keyword=2021">Kinerja Karya Seni</a>
                                    </li>
                                    <li class="{{ 'kinerja_koran' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_koran?keyword=&keyword=2021">Kinerja Koran</a>
                                    </li>
                                    <li class="{{ 'kinerja_pembicara' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_pembicara?keyword=&keyword=2021">Kinerja Pembicara</a>
                                    </li>
                                    <li class="{{ 'kinerja_pengabdian' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_pengabdian?keyword=&keyword=2021">Kinerja Pengabdian</a>
                                    </li>
                                    <li class="{{ 'kinerja_program' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_program?keyword=&keyword=2021">Kinerja Program</a>
                                    </li>
                                    <li class="{{ 'kinerja_reviewer' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_reviewer?keyword=&keyword=2021">Kinerja Reviewer</a>
                                    </li>
                                    <li class="{{ 'kinerja_scopus' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_scopus?keyword=&keyword=2021">Kinerja Scopus</a>
                                    </li>
                                    <li class="{{ 'kinerja_seminar' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_seminar?keyword=&keyword=2021">Kinerja Seminar</a>
                                    </li>
                                    {{-- <li class="{{ 'kinerja_varietas' == request()->path() ? 'active' : '' }}">
                                    <a href="/kinerja_varietas">Kinerja Varietas</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                    </ul>
                </li>
                <li class="{{ '' == request()->path() ? 'active' : '' }}"><a href="/data_penelitian?keyword=&keyword=2021" class="waves-effect waves-cyan"><i class="mdi-action-description"></i> Data Penelitian</a>
                </li>
                {{-- <li class="{{ '' == request()->path() ? 'active' : '' }}"><a href="" class="waves-effect waves-cyan"><i class="mdi-action-accessibility"></i> Data Pengabdian</a>
                </li> --}}
                {{-- <li class="{{ '' == request()->path() ? 'active' : '' }}"><a href="/data_kunjungan" class="waves-effect waves-cyan"><i class="mdi-maps-local-airport"></i> Data Kunjungan</a>
                </li> --}}
               
            </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
            <!-- END LEFT SIDEBAR NAV-->

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START CONTENT -->
            <section id="content">
                @yield('content')
                
                <!--start container-->
                <div class="container">
                    <!--chart dashboard start-->
                    @yield('container')
         
                    <!-- Floating Action Button -->
                    {{-- <div class="fixed-action-btn" style="bottom: 30px;  right: 19px;">
                        <a class="btn-floating btn-large">
                          <i class="mdi-action-stars"></i>
                        </a>
                        <ul>
                          <li><a href="css-helpers.htm" class="btn-floating red"><i class="large mdi-communication-live-help"></i></a></li>
                          <li><a href="app-widget.htm" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
                          <li><a href="app-calendar.htm" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
                          <li><a href="app-email.htm" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
                        </ul>
                    </div> --}}
                    <!-- Floating Action Button -->

                </div>
                <!--end container-->
                </section>
            <!-- END CONTENT -->

            <!-- START RIGHT SIDEBAR NAV-->
            <aside id="right-sidebar-nav">
                <ul id="chat-out" class="side-nav rightside-navigation">
                    <li class="li-hover">
                    <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
                    <div id="right-search" class="row">
                        <form class="col s12">
                            <div class="input-field">
                                <i class="mdi-action-search prefix"></i>
                                <input id="icon_prefix" type="text" class="validate">
                                <label for="icon_prefix">Search</label>
                            </div>
                        </form>
                    </div>
                    </li>
                    <li class="li-hover">
                        <ul class="chat-collapsible" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                            <div class="collapsible-body recent-activity">
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">just now</a>
                                        <p>Jim Doe Purchased new equipments for zonal office.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">Yesterday</a>
                                        <p>Your Next flight for USA will be on 15th August 2015.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">5 Days Ago</a>
                                        <p>Natalya Parker Send you a voice mail for next conference.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">Last Week</a>
                                        <p>Jessy Jay open a new store at S.G Road.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">5 Days Ago</a>
                                        <p>Natalya Parker Send you a voice mail for next conference.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                            <div class="collapsible-body sales-repoart">
                                <div class="sales-repoart-list  chat-out-list row">
                                    <div class="col s8">Target Salse</div>
                                    <div class="col s4"><span id="sales-line-1"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Payment Due</div>
                                    <div class="col s4"><span id="sales-bar-1"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Total Delivery</div>
                                    <div class="col s4"><span id="sales-line-2"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Total Progress</div>
                                    <div class="col s4"><span id="sales-bar-2"></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                            <div class="collapsible-body favorite-associates">
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Eileen Sideways</p>
                                        <p class="place">Los Angeles, CA</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Zaham Sindil</p>
                                        <p class="place">San Francisco, CA</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Renov Leongal</p>
                                        <p class="place">Cebu City, Philippines</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Weno Carasbong</p>
                                        <p>Tokyo, Japan</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Nusja Nawancali</p>
                                        <p class="place">Bangkok, Thailand</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- LEFT RIGHT SIDEBAR NAV-->

        
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer" {{-- style="position: absolute; width:100%;" --}}>
        
        <div class="footer-copyright">
            <div class="container">
                Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js\plugins\jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js\materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js\plugins\perfect-scrollbar\perfect-scrollbar.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js\plugins\prism\prism.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js\plugins\data-tables\js\jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js\plugins\data-tables\data-tables-script.js"></script>
    
    @yield('table')
    <!-- chartist -->
    <script type="text/javascript" src="js\plugins\chartist-js\chartist.min.js"></script>   
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    {{-- <script type="text/javascript">
        /*Show entries on click hide*/
        $(document).ready(function(){
            $(".dropdown-content.select-dropdown li").on( "click", function() {
                var that = this;
                setTimeout(function(){
                if($(that).parent().hasClass('active')){
                        $(that).parent().removeClass('active');
                        $(that).parent().hide();
                }
                },100);
            });
        });
    </script> --}}
    
    <!-- chartjs -->
    <script type="text/javascript" src="js\plugins\chartjs\chart.min.js"></script>
    <script type="text/javascript" src="js\plugins\chartjs\chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js\plugins\sparkline\jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js\plugins\sparkline\sparkline-script.js"></script>
    
    <!-- google map api -->
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script> --}}

    <!--jvectormap-->
    <script type="text/javascript" src="js\plugins\jvectormap\jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="js\plugins\jvectormap\jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="js\plugins\jvectormap\vectormap-script.js"></script>
    
    <!--google map-->
    {{-- <script type="text/javascript" src="js\plugins\google-map\google-map-script.js"></script> --}}
    @yield('graph')
    @yield('graph2')
    @yield('graph3')
    @yield('graph4')
    @yield('graph5')
    @yield('graph6')
    @yield('graph7')
    @yield('graph8')
    @yield('graph9')
    @yield('graph10')
    @yield('graph11')
    @yield('graph12')
    @yield('graph13')
    @yield('graph14')
    @yield('graph15')
    @yield('graph16')
    @yield('graph17')
    @yield('graph18')
    @yield('graph19')
    @yield('graph20')
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js\plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    {{-- <script type="text/javascript" src="js\custom-script.js"></script>
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script> --}}
  {{--   @yield('script')
    @stack('scripts') --}}


    <link rel="stylesheet" href="/lib/bootstrap.min.css">
  <script src="/lib/jquery-1.12.2.min.js"></script>
  <script src="/lib/bootstrap.min.js"></script>
    @yield('collapse')
    <!-- Toast Notification -->
    {{-- <script type="text/javascript">
    // Toast Notification
    /* $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 1500);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5000);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 15000);
    }); */
    
    </script> --}}
    
        
    
</body>




</html>


