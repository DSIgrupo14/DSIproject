@extends('layouts.general')

@section('titulo', 'CEAA | Pago de Alimentos')

@section('encabezado', 'Pago de Alimentos')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-cutlery"></i> <a href="{{ route('pagos.index') }}"> Pago de Alimentos</a>
</li>
<li class="active">
  Editar Pago de Alimentos
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Pago de Alimentos</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['pagos.update', $pago], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Año -->
      <div class="form-group{{ $errors->has('anio_id') ? ' has-error' : '' }}">
        {!! Form::label('anio_id', 'Año', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('anio_id', $anios, $pago->anio_id, ['class' => 'form-control', 'placeholder' => '-- Seleccione un año --', 'required']) !!}
          @if ($errors->has('anio_id'))
          <span class="help-block">{{ $errors->first('anio_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Mes -->
      <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }}">
        {!! Form::label('mes', 'Mes', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('mes', [
             '1' => 'Enero',
             '2' => 'Febrero',
             '3' => 'Marzo',
             '4' => 'Abril',
             '5' => 'Mayo',
             '6' => 'Junio',
             '7' => 'Julio',
             '8' => 'Agosto',
             '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
            ], $pago->mes, ['class' => 'form-control', 'placeholder' => '-- Seleccione un mes --', 'required']) !!}
          @if ($errors->has('mes'))
          <span class="help-block">{{ $errors->first('mes') }}</span>
          @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('pagos.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection