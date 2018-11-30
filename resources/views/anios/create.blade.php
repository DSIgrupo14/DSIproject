@extends('layouts.general')

@section('titulo', 'CEAA | Crear Año Escolar')

@section('encabezado', 'Año Escolar')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li>
  <a href="{{ route('anios.index') }}">Año Escolar</a>
</li>
<li class="active">
  Registrar Año Escolar
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Año Escolar</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'anios.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Número -->
      <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
        {!! Form::label('numero', 'Año', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::number('numero', old('numero'), ['class' => 'form-control', 'placeholder' => 'Año Escolar', 'required']) !!}
            @if ($errors->has('numero'))
            <span class="help-block">{{ $errors->first('numero') }}</span>
            @endif
        </div>
      </div>

      <!-- Activo -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('activo', 1) !!} Activo
              <span class="help-block"><small>Indica si este es el año escolar que actualmente se está impartiendo. Permite visualizar primero los registros pertenecientes a este año. Solo puede existir un año escolar activo, al marcar, a todos los demás años registrados se le asigna el valor de inactivo. Si el año es activo, automáticamente es editable.</small></span>
            </label>
          </div>
        </div>
      </div>

      <!-- Editable -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('editable', 1) !!} Editable
              <span class="help-block"><small>Indica si es permitido que registros pertenecientes a este año escolar puedan ser editados. En caso de no marcar, los registros pertenecientes a este año no podrán visualizarse en el sistema.</small></span>
            </label>
          </div>
        </div>
      </div>


    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('anios.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection