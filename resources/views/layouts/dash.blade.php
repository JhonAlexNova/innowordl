<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CONYEATS - @yield('title','Dashboard')</title>

    <!-- Styles -->
    <link href="{{ asset('template/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet" >
    <!-- Vectormap -->
    <link href="{{ asset('template/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('template/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('template/cdn.lineicons.com/2.0/LineIcons.css')}}" rel="stylesheet">
    <link href="{{ asset('template/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">


    <!--scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="javascript:void(0);" class="brand-logo">
                <img class="brand-title" src="{{url('/')}}/img/logo_blanco.png" alt="">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>




        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <div class="rols">
                                    <form action="">
                                        
                                    </form>
                                    <select>
                                        @foreach(Session::get('rols') as $rol)
                                           <option value=""> {{$rol->tipo}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{url('')}}/template/images/profile/17.jpg" width="20" alt=""/>
                                    <div class="header-info">
                                        <span class="text-black"> {{Auth::user()->nombres}} </span>
                                        <p class="fs-12 mb-0">{{Auth::user()->apellidos}}</p>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Salir </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                      </form> 
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="mm-active">
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Usuarios </span>
                        </a>
                        <ul aria-expanded="false" class="mm-collapse mm-show">
                            <li><a href="{{url('/app/usuarios/create')}}">Registro</a></li>
                            <li><a href="{{url('/app/usuarios/importar')}}">Importar</a></li>
                            <li><a href="{{url('/app/usuarios')}}">Nuevos clientes</a></li>
                        </ul>
                    </li>

                    
                    <li class="mm-active" style="display: none;">
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Configuraciones </span>
                        </a>
                        <ul aria-expanded="false" class="mm-collapse mm-show">
                            <li><a href="{{url('/app/usuarios')}}">Todos los usuarios</a></li>
                            <li><a href="{{url('/app/usuarios/create')}}">Registro</a></li>
                            <li><a href="{{url('/app/usuarios/importar')}}">Importar</a></li>
                        </ul>
                    </li>

                </ul>
                
                
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright ©  Developer by <a href="http://www.appsstars.com.co" target="_blank">Apps Stars</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('template/vendor/global/global.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('template/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('template/js/custom.min.js')}}"></script>
    <script src="{{ asset('template/js/deznav-init.js')}}"></script>
    <script src="{{ asset('template/vendor/owl-carousel/owl.carousel.js')}}"></script>
        
    
    <!-- Chart piety plugin files -->
    <script src="{{ asset('template/vendor/peity/jquery.peity.min.js')}}"></script>
    
    <!-- Dashboard 1 -->
    <script src="{{ asset('template/js/dashboard/dashboard-1.js')}}"></script>



    
    <!-- Datatable -->
    <script src="{{ asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('template/js/plugins-init/datatables.init.js')}}"></script>
    
    <script>
        function carouselReview(){
            /*  testimonial one function by = owl.carousel.js */
            /*  testimonial one function by = owl.carousel.js */
            jQuery('.testimonial-one').owlCarousel({
                loop:true,
                autoplay:true,
                margin:15,
                nav:false,
                dots: false,
                left:true,
                navText: ['', ''],
                responsive:{
                    0:{
                        items:1
                    },
                    800:{
                        items:2
                    },  
                    991:{
                        items:2
                    },          
                    
                    1200:{
                        items:2
                    },
                    1600:{
                        items:2
                    }
                }
            })      
            jQuery('.testimonial-two').owlCarousel({
                loop:true,
                autoplay:true,
                margin:15,
                nav:false,
                dots: true,
                left:true,
                navText: ['', ''],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },  
                    991:{
                        items:3
                    },          
                    
                    1200:{
                        items:3
                    },
                    1600:{
                        items:4
                    }
                }
            })                  
        }
        
        jQuery(window).on('load',function(){
            setTimeout(function(){
                carouselReview();
            }, 1000); 
            $('#example2').DataTable();
        });

        
    </script>
</body>













































   
</body>
</html>
