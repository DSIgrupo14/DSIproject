@extends('layouts.general')

@section('titulo', 'CEAA | Matrículas')

@section('encabezado', 'Matrículas')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-child"></i>
  <a href="{{ route('matriculas.index') }}">Matrículas</a>
</li>
<li class="active">
  Registrar Matrícula
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Matrícula</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['matriculas.update', $matricula], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Alumno -->
      <div class="form-group">
        {!! Form::label('alumno_id', 'Alumno', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('alumno_id', $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido, ['class' => 'form-control', 'disabled']) !!}
        </div>
      </div>
      <!-- Grado -->
      <div class="form-group">
        {!! Form::label('grado_id', 'Grado', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('grado_id', $matricula->grado->codigo, ['class' => 'form-control', 'disabled']) !!}
        </div>
      </div>
      <!-- Fecha de matriculación -->
      <div class="form-group">
        {!! Form::label('created_at', 'Fecha de matriculación', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('created_at', \Carbon\Carbon::parse($matricula->created_at)->format('d/m/Y'), ['class' => 'form-control', 'disabled']) !!}
        </div>
      </div>
      <!-- Deserción -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('desercion', 1, $desercion) !!} Alumno desertó
            </label>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('matriculas.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection