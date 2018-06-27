@extends('layouts.general')

@section('titulo', 'CEAA | Roles de usuario')

@section('encabezado', 'Roles de usuario')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-shield"></i> Seguridad
</li>
<li>
  <a href="{{ route('roles.index') }}">Roles de usuario</a>
</li>
<li class="active">
  Editar Rol de Usuario
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Rol de Usuario</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['roles.update', $rol], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', $rol->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del rol de usuario', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('roles.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection