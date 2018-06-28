@extends('layouts.general')

@section('titulo', 'CEAA | Nivel Educativo')

@section('encabezado', 'Nivel Educativo')

@section('subencabezado', 'Editar')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Administracion
</li>
<li>
  <a href="{{ route('nivel.index') }}">Nivel Educativo</a>
</li>
<li class="active">
  Editar NivelEducativo
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Nivel Educativo</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['nivel.update',$nivel], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Código -->
      <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('Codigo', 'Codigo', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('codigo', $nivel->codigo, ['class' => 'form-control', 'placeholder' => 'Codigo', 'required']) !!}
            @if ($errors->has('codigo'))
            <span class="help-block">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
      </div>
      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', $nivel->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre de nivel', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>
    </div>
    <!-- Especialidad -->
      <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
        {!! Form::label('orientador_materia', 'orientador_materia', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('orientador_materia', $nivel->orientador_materia, ['class' => 'form-control', 'placeholder' => 'Orientador_materia', 'required']) !!}
            @if ($errors->has('orientador_materia'))
            <span class="help-block">{{ $errors->first('orientador_materia') }}</span>
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
