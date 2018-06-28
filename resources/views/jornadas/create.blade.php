@extends('layouts.general')

@section('titulo', 'CEAA | Crear Jornada Laboral')

@section('encabezado', 'Crear Jornada Laboral')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('docentes.index') }}">Jornada Laboral</a>
</li>
<li class="active">
  Registrar Jornada Laboral
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Jornada Laboral</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'jornadas.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

       <!-- Id de Usuario -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('docente_id', 'Apellido del Docente', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('docente_id', $docentes, old('docente_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un Apellido --', 'required']) !!}
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
        {!! Form::label('fecha', 'Fecha', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('fecha', old('fecha'), ['class' => 'form-control', 'placeholder' => 'Fecha de la Jornada Laboral', 'required']) !!}
            @if ($errors->has('fecha'))
            <span class="help-block">{{ $errors->first('fecha') }}</span>
            @endif
        </div>
      </div>
    </div>
    <!-- Especialidad -->
      <div class="form-group{{ $errors->has('hora_entrada') ? ' has-error' : '' }}">
        {!! Form::label('hora_entrada', 'Hora Entrada', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('hora_entrada', old('hora_entrada'), ['class' => 'form-control', 'placeholder' => 'Hora de Entrada ', 'required']) !!}
            @if ($errors->has('hora_entrada'))
            <span class="help-block">{{ $errors->first('hora_entrada') }}</span>
            @endif
        </div>
      </div>

 <!-- Especialidad -->
      <div class="form-group{{ $errors->has('hora_salida') ? ' has-error' : '' }}">
        {!! Form::label('hora_salida', 'Hora Salida', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('hora_salida', old('hora_salida'), ['class' => 'form-control', 'placeholder' => 'Hora de Salida ', 'required']) !!}
            @if ($errors->has('hora_salida'))
            <span class="help-block">{{ $errors->first('hora_salida') }}</span>
            @endif
        </div>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('jornadas.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection