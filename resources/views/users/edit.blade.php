@extends('layouts.general')

@section('titulo', 'CEAA | Usuarios')

@section('encabezado', 'Usuarios')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-shield"></i> Seguridad
</li>
<li>
  <a href="{{ route('users.index') }}">Usuarios</a>
</li>
<li class="active">
  Editar Usuario
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Usuario</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['users.update', $user], 'autocomplete' => 'off', 'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', $user->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del usuario', 'required']) !!}
          @if ($errors->has('nombre'))
          <span class="help-block">{{ $errors->first('nombre') }}</span>
          @endif
        </div>
      </div>
      <!-- Apellido -->
      <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
        {!! Form::label('apellido', 'Apellido', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('apellido', $user->apellido, ['class' => 'form-control', 'placeholder' => 'Apellido del usuario', 'required']) !!}
          @if ($errors->has('apellido'))
          <span class="help-block">{{ $errors->first('apellido') }}</span>
          @endif
        </div>
      </div>
      <!-- Email -->
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Correo electrónico', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required']) !!}
          @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
          @endif
        </div>
      </div>
      <!-- Password -->
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', 'Contraseña', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nueva contraseña']) !!}
          @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>
      </div>
      <!-- Confirmar password -->
      <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar nueva contraseña']) !!}
        </div>
      </div>
      <!-- DUI -->
      <div class="form-group{{ $errors->has('dui') ? ' has-error' : '' }}">
        {!! Form::label('dui', 'DUI', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('dui', $user->dui, ['class' => 'form-control', 'placeholder' => 'Documento Único de Identidad', 'required', 'data-inputmask' => '"mask": "99999999-9"', 'data-mask']) !!}
          @if ($errors->has('dui'))
          <span class="help-block">{{ $errors->first('dui') }}</span>
          @endif
        </div>
      </div>
      <!-- Rol de usuario -->
      <div class="form-group{{ $errors->has('rol_id') ? ' has-error' : '' }}">
        {!! Form::label('rol_id', 'Rol de usuario', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('rol_id', $roles, $user->rol_id, ['class' => 'form-control', 'placeholder' => '-- Seleccione un rol de usuario --', 'required']) !!}
          @if ($errors->has('rol_id'))
          <span class="help-block">{{ $errors->first('rol_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Imagen -->
      <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
        {!! Form::label('imagen', 'Imagen', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::file('imagen', ['class' => 'input-alinear']) !!}
          @if ($errors->has('imagen'))
          <span class="help-block">{{ $errors->first('imagen') }}</span>
          @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('users.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>
@endsection