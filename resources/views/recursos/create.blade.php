@extends('layouts.general')

@section('titulo', 'CEAA | Crear Recurso')

@section('encabezado', 'Recursos')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li>
  <a href="{{ route('recursos.index') }}">Recursos</a>
</li>
<li class="active">
  Registrar Recurso
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Recurso</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'recursos.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- nombre-->

      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre del Recurso', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>

      <!-- descripcion -->
      <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
        {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textArea('descripcion', old('descripcion'), ['class' => 'form-control', 'placeholder' => 'descripcion', 'required']) !!}
            @if ($errors->has('descripcion'))
            <span class="help-block">{{ $errors->first('descripcion') }}</span>
            @endif
        </div>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('recursos.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection