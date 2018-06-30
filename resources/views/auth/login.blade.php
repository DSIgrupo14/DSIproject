@extends('layouts.login')

@section('titulo', 'CEAA | Iniciar sesión')

@section('login-msg', 'Iniciar sesión')

@section('formulario')
<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
  @csrf
  <div class="form-group has-feedback">
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
    @endif
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password" required>
    @if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
    @endif
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
    </div>
    <!-- /.col -->
  </div>
</form>
<div class="text-center">
  <br>
  <a href="{{ route('password.request') }}" class="text-center">Olvidé mi contraseña</a>
</div>
@endsection
