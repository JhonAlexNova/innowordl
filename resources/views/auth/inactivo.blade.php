@extends('layouts.app')

@section('content')
<style>
    form{
        height: 200px;
    }
</style>
<section id="login">
    <div class="container">
        <form action="" style="height: 200px">
            <div class="alert alert-warning">
                 @if(Auth::user())
                    @if(Auth::user()->estado!='activo')
                        <b>{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</b><b> Su estado actual esta inactivo.</b><br>
                        <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           
                            <span class="ml-2">Cerrar la sesión </span>
                        </a>
                    @else
                       <script>
                           location.href = '/app';
                       </script>
                    @endif
                @else
                     <script>
                           location.href = '/';
                       </script>
                @endif
                
            </div>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
        </form> 
    </div>
</section>  
@endsection
