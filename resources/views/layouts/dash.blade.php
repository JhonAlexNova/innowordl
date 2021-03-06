<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INNOWORDL - @yield('title','Dashboard')</title>

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
    <link href="{{ asset('lib/toastr/build/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">


    <!--scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="javascript:void(0);" class="brand-logo">
                <img class="brand-title" src="{{url('/')}}/img/logo_blanco.png" alt="">
            </a>
            <span class="perfil">
                   <i class=" fa fa-user"></i> {{ Auth::user()->nombres }}<br>{{ Auth::user()->apellidos }}

                </span>
            
        </div>




        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <div class="rols"> 
                                    <select name="rol_select_active">
                                        @foreach(Session::get('rols') as $rol)
                                            @if(Session::get('id_rol') == $rol->id_rol)
                                                <option value="{{ $rol->id_rol }}" selected> {{$rol->tipo}} </option>
                                            @else
                                                <option value="{{ $rol->id_rol }}"> {{$rol->tipo}} </option>
                                            @endif
                                           
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{ url('img/avatar',Auth::user()->avatar) }}" width="20" alt=""/>
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
                        <li><a class="has-link" href="{{url('/app')}}"> <i class="flaticon-381-networking"></i>Panel</a></li>
                     @if(Session::get('id_rol') == 2 || Session::get('id_rol') == 3)
                        
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="nav-text">Usuarios </span>
                            </a>
                            <ul aria-expanded="false" class="mm-collapse">
                                <li><a href="{{url('/app/usuarios/create')}}">Registro</a></li>
                                <li><a href="{{url('/app/usuarios/create?page=import')}}">Importar</a></li>
                                <li><a href="{{url('/app/usuarios?page=nuevos_clientes&type=list')}}">Nuevos clientes</a></li>
                                @if(Session::get('id_rol')== 1 || Session::get('id_rol') == 2)
                                    <li><a href="{{url('/app/usuarios?page=all&type=list')}}">Todos</a></li>
                                @endif
                            </ul>
                        </li>

                        <li><a class="has-link" href="{{url('/app/usuarios?page=tareas_dia&type=list')}}"> <i class="flaticon-381-networking"></i>TAREAS DEL DIA</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=tareas_vencidas&type=list')}}"> <i class="flaticon-381-networking"></i>TAREAS VENCIDAS</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=facturar&type=list')}}"> <i class="flaticon-381-networking"></i>FACTURAR</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=facturacion_pendiente_pago&type=list')}}"> <i class="flaticon-381-networking"></i>PENDIENTES POR PAGO</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=matriculados&type=list')}}"> <i class="flaticon-381-networking"></i>MATRICULADOS</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=entrevistas&type=list')}}"> <i class="flaticon-381-networking"></i>Entrevistas</a></li>
                        <li><a class="has-link" href="{{url('/app/usuarios?page=grupos&type=list')}}"> <i class="flaticon-381-networking"></i>Grupos</a></li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="nav-text">Estudiantes</span>
                            </a>
                            <ul aria-expanded="false" class="mm-collapse">
                                <li><a href="{{url('/app/usuarios/?page=estudiantes_nuevos&type=list')}}">Nuevos</a></li>
                                <li><a href="{{url('/app/usuarios/?page=estudiantes_activos&type=list')}}">Activos</a></li>
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
                        @endif


                        @if(Session::get('id_rol') == 4)


                        @endif

                        @if(Session::get('id_rol') == 5)
                            <li>
                                <a class="has-link" href="{{url('/app/cartera?page=recompra&type=list')}}"> <i class="flaticon-381-networking"></i>RECOMPRA</a>
                            </li>
                            <li>
                                <a class="has-link" href="{{url('/app/cartera?page=tareas_dia&type=list')}}"> <i class="flaticon-381-networking"></i>TAREAS DEL DIA</a>
                            </li>
                             <li>
                                <a class="has-link" href="{{url('/app/cartera?page=tareas_vencidas&type=list')}}"> <i class="flaticon-381-networking"></i>TAREAS VENCIADAS</a>
                            </li>
                             <li>
                                <a class="has-link" href="{{url('/app/cartera?page=facturar&type=list')}}"> <i class="flaticon-381-networking"></i>FACTURAR</a>
                            </li>
                             <li>
                                <a class="has-link" href="{{url('/app/cartera?page=facturacion_pendiente_pago&type=list')}}"> <i class="flaticon-381-networking"></i>PENDIENTES POR PAGO</a>
                            </li>

                             <li>
                                <a class="has-link" href="{{url('/app/cartera?page=tareas_dia&type=list')}}"> <i class="flaticon-381-networking"></i>MATRICULADOS</a>
                            </li>
                        @endif
                    </ul>

                

                <div class="copyright">
                    <p><strong>Configuración</strong> </p>
                    <p></p>
                </div>

                <ul class="metismenu" id="submenu" style="margin-top: -40px">
                    @if(Session::get('id_rol')==2)
                         <li><a class="has-link" href="{{url('/app/usuarios?page=permisos')}}"> <i class="flaticon-381-networking"></i>Permisos</a></li>
                    @endif
                    <li><a class="has-link" href="{{url('/app/usuarios?page=profile')}}"> <i class="flaticon-381-networking"></i>Mis datos</a></li>
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

    <script src="{{ asset('lib/toastr/build/toastr.min.js')}}"></script>
    
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

        $(document).on('change','select[name=rol_select_active]',function(e){
            var id_rol = e.target.value;
            var new_session =  "{{ url('app/rol') }}?id_rol="+id_rol;
            location.href = new_session;
        });

    </script>
</body>













































   
</body>
</html>
