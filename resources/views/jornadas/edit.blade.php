@extends('layouts.general')

@section('titulo', 'CEAA | Editar Jornada Laboral')

@section('encabezado', 'Jornada Laboral')

@section('subencabezado', 'Editar')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('jornadas.index') }}">Jornada Laboral</a>
</li>
<li class="active">
 Editar Jornada Laboral
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Jornada Laboral</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['jornadas.update', $jornada], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

       <!-- ID del Usuario -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('docente_id', 'Docente', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('docente_id', $docentes, $jornada->docente_id, ['class' => 'form-control', 'readonly', 'placeholder' => '-- Seleccione un Docente --', 'required']) !!}
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
        {!! Form::label('fecha', 'Fecha', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::date('fecha', $jornada->fecha, ['class' => 'form-control', 'placeholder' => 'Fecha de Jornada Laboral', 'required']) !!}
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
          {!! Form::time('hora_entrada', $jornada->hora_entrada, ['class' => 'form-control', 'required','min'=>'6:00', 'max'=>'22:00','step'=>'3600']) !!}
            @if ($errors->has('hora_entrada'))
            <span class="help-block">{{ $errors->first('hora_entrada') }}</span>
            @endif
        </div>
      </div>

      <!-- Especialidad -->
      <div class="form-group{{ $errors->has('hora_salida') ? ' has-error' : '' }}">
        {!! Form::label('hora_salida', 'Hora Salida', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::time('hora_salida', $jornada->hora_salida, ['class' => 'form-control', 'required', 'min'=>'6:00', 'max'=>'22:00','step'=>'3600']) !!}
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