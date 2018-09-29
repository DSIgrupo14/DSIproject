@extends('layouts.general')

@section('titulo', 'CEAA | Evaluaciones')

@section('encabezado', 'Evaluaciones')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">
  <a href="{{ route('notas.edit', $gra_mat) }}">{{ $evaluacion->grado->codigo }} - {{ $evaluacion->materia->nombre }}</a>
</li>
<li class="active">Editar Evaluación</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Evaluación</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['evaluaciones.update', $evaluacion], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Grado -->
      <div class="form-group{{ $errors->has('grado_id') ? ' has-error' : '' }}">
        {!! Form::label('grado_id', 'Grado *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('grado_v', $evaluacion->grado->codigo, ['class' => 'form-control', 'disabled', 'required']) !!}
          {!! Form::hidden('grado_id', $evaluacion->grado->id, ['required']) !!}
          @if ($errors->has('grado_id'))
          <span class="help-block">{{ $errors->first('grado_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Materia -->
      <div class="form-group{{ $errors->has('materia_id') ? ' has-error' : '' }}">
        {!! Form::label('materia', 'Materia *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('materia_v', $evaluacion->materia->nombre, ['class' => 'form-control', 'disabled', 'required']) !!}
          {!! Form::hidden('materia_id', $evaluacion->materia->id, ['required']) !!}
          @if ($errors->has('materia_id'))
          <span class="help-block">{{ $errors->first('materia_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Trimestre -->
      <div class="form-group{{ $errors->has('trimestre') ? ' has-error' : '' }}">
        {!! Form::label('trimestre', 'Trimestre *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('trimestre', ['1' => '1', '2' => '2', '3' => '3'], $evaluacion->trimestre, ['class' => 'form-control', 'placeholder' => '-- Seleccione un trimestre --', 'required'] ) !!}
          @if ($errors->has('trimestre'))
          <span class="help-block">{{ $errors->first('trimestre') }}</span>
          @endif
        </div>
      </div>
      <!-- Tipo -->
      <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
        {!! Form::label('tipo', 'Tipo *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('tipo', ['ACT' => 'Actividad', 'EXA' => 'Examen'], $evaluacion->tipo, ['class' => 'form-control', 'placeholder' => '-- Seleccione un tipo de evaluación --', 'required'] ) !!}
          @if ($errors->has('tipo'))
          <span class="help-block">{{ $errors->first('tipo') }}</span>
          @endif
        </div>
      </div>
      <!-- Porcentaje -->
      <div class="form-group{{ $errors->has('porcentaje') ? ' has-error' : '' }}">
        {!! Form::label('porcentaje', 'Porcentaje *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          <div class="input-group">
            {!! Form::number('porcentaje', $evaluacion->porcentaje * 100, ['class' => 'form-control', 'placeholder' => 'Porcentaje de la evaluación', 'required', 'min' => '1', 'max' => '35']) !!}
            <div class="input-group-addon">%</div>
          </div>
            @if ($errors->has('porcentaje'))
            <span class="help-block">{{ $errors->first('porcentaje') }}</span>
            @endif
        </div>
      </div>
      {!! Form::hidden('gra_mat', $gra_mat, ['required']) !!}
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('notas.edit', $gra_mat) }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection