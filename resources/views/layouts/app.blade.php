<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SAP Request') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Miriam+Libre:400,700|Source+Sans+Pro:300,400,700" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" /> 
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                             <li>
                            <a href="#"><i class="ion-android-options"></i> Status </a>
                            </li>

                            <li>
                            <a href="#"><i class="ion-android-notifications-none"></i> Notification </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 <i class="ion-android-person"></i>   {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container"> 
      <div class="row">

        <div class="col-sm-3 sidebar">


       <div class="list-group item-group-sidebar">
          <a href="{{url('home')}}"  class="{{ Request::path() == 'home' ? 'active' : '' }} list-group-item item-sidebar">
           <i class="ion-ios-speedometer"></i> Dashboard
          </a>
        </div>


        <div class="list-group item-group-sidebar">
          <a href="{{url('missings')}}" class="{{ Request::path() == 'missings/create' ? 'active' : '' }} list-group-item item-sidebar">
           <i class="ion-android-unlock"></i> Missing Authorization
          </a>

          <a href="{{url('sapusers')}}" class="{{ Request::path() == 'sapusers/create' ? 'active' : '' }} list-group-item item-sidebar">
          <i class="ion-android-person-add"></i> User Creation
          </a>
          
        </div>

        @role(('Administrator'))
          <div class="list-group item-group-sidebar">
          <a href="#" class="list-group-item item-sidebar">
           <i class="ion-gear-b"></i> Data Management
          </a>
          <a href="{{url('users')}}" class="{{ Request::path() == 'users' ? 'active' : '' }} list-group-item item-sidebar">
            <i class="ion-person-stalker"></i>  User Management
          </a>
          <a href="{{url('roles')}}" class="{{ Request::path() == 'roles' ? 'active' : '' }} list-group-item item-sidebar">
          <i class="ion-key"></i> Role Management
          </a>
        </div>
        @endrole




       


        </div><!-- sidebar -->
        <div class="col-sm-9 main">

         @yield('content')

        </div><!-- main -->


      </div><!-- /.row -->

        </div>

       
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    @include('flashy::message')
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
     <script src="{{asset('/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
       <script>
       $(":file").filestyle({size: "sm", buttonName: "btn-primary", buttonBefore: true, buttonText: "&nbsp;Image"});
     </script>

      <!-- datatables   -->  
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.columnFilter.js') }}"></script>
    <script src="{{ asset('js/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>

    <script type="text/javascript">
     $(document).ready(function() {
    $('#datatable').DataTable();
   });
    </script>


</body>
</html>
