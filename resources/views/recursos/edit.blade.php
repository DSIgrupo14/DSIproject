@extends('layouts.general')

@section('titulo', 'CEAA | Editar Recurso')

@section('encabezado', 'Recurso')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Administracion
</li>
<li>
  <a href="{{ route('recursos.index') }}">Recurso</a>
</li>
<li class="active">
  Editar Recurso
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Recurso</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['recursos.update', $recurso], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', $recurso->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del recurso', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>

      <!-- Valor -->
      <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
        {!! Form::label('descripcion', 'descripcion', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textArea('descripcion', $recurso->descripcion, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
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