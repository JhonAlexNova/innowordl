@extends('layouts.app')

@section('content')
<section id="login">
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <div class="logo">
                    <img src="{{url('img/logo.png')}}" alt="">
                </div>
            </div>
           <div class="form-group">
                <label for="documento">{{ __('Usuario') }}</label>
                <input id="documento" type="text" class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ old('documento') }}" required autocomplete="documento" autofocus>

                @error('documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> 

        
            <div class="form-group">
                <label for="password" >{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-outline-primary">ACCEDER</button>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-outline-success">RECUPERAR ACCESO</button>
            </div>
        </form>
    </div>
</section>  
@endsection
