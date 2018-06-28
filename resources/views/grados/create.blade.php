@extends('layouts.general')

@section('titulo', 'CEAA | Crear Grado')

@section('encabezado', 'Crear Grado')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Gestión Académica
</li>
<li>
  <a href="{{ route('docentes.index') }}">Grado</a>
</li>
<li class="active">
  Registrar Grado
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Grado</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'grados.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Nivel Academico -->
      <div class="form-group{{ $errors->has('nivel_id') ? ' has-error' : '' }}">
        {!! Form::label('nivel_id>', 'Nivel Academico', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('nivel_id', $niveles, old('nivel_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un nivel academico --', 'required']) !!}
          @if ($errors->has('nivel_id'))
          <span class="help-block">{{ $errors->first('nivel_id') }}</span>
          @endif
        </div>
      </div>

     <!-- Anio -->
      <div class="form-group{{ $errors->has('anio_id') ? ' has-error' : '' }}">
        {!! Form::label('numero>', 'Año Academico', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('anio_id', $anios, old('anio_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un Año --', 'required']) !!}
          @if ($errors->has('anio_id'))
          <span class="help-block">{{ $errors->first('anio_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Docente -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre del Docente', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('docente_id', $docentes, old('docente_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un Docente --', 'required']) !!} 
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Código -->
      <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
        {!! Form::label('Codigo', 'Codigo', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('codigo', old('codigo'), ['class' => 'form-control', 'placeholder' => 'Codigo del Grado', 'required']) !!}
            @if ($errors->has('codigo'))
            <span class="help-block">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
      </div>

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('seccion') ? ' has-error' : '' }}">
        {!! Form::label('Seccion', 'Seccion', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('seccion', old('seccion'), ['class' => 'form-control', 'placeholder' => 'Seccion ', 'required']) !!}
            @if ($errors->has('seccion'))
            <span class="help-block">{{ $errors->first('seccion') }}</span>
            @endif
        </div>
      </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('materias.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection