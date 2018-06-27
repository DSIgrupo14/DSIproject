@extends('layouts.general')

@section('titulo', 'CEAA | Crear Docente')

@section('encabezado', 'Crear Docente')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('docentes.index') }}">Docente</a>
</li>
<li class="active">
  Registrar Docente
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Docente</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'docentes.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

       <!-- Id de Usuario -->
      <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('user_id', 'Apellido del Docente', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un Apellido --', 'required']) !!}
          @if ($errors->has('user_id'))
          <span class="help-block">{{ $errors->first('user_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        {!! Form::label('nip', 'Nip', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nip', old('nip'), ['class' => 'form-control', 'placeholder' => 'Nip del Docente', 'required']) !!}
            @if ($errors->has('nip'))
            <span class="help-block">{{ $errors->first('nip') }}</span>
            @endif
        </div>
      </div>
    </div>
    <!-- Especialidad -->
      <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
        {!! Form::label('especialidad', 'Especialidad', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('especialidad', old('especialidad'), ['class' => 'form-control', 'placeholder' => 'Especialidad del Docente', 'required']) !!}
            @if ($errors->has('especialidad'))
            <span class="help-block">{{ $errors->first('especialidad') }}</span>
            @endif
        </div>
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('docentes.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection