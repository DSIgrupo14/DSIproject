@extends('layouts.general')

@section('titulo', 'CEAA | Jornada Laboral')

@section('encabezado', 'Jornada Laboral')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-clock-o"></i>
  <a href="{{ route('jornadas.index') }}">Jornada Laboral</a>
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
      <!-- Docente -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('docente_id', 'Docente', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          <select id="docente_id" name="docente_id" class="form-control" required>
            <option selected="selected" value="">-- Seleccione al docente --</option>
            @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
            @endforeach
          </select>
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Fecha -->
      <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }} input-btn-alinear">
        {!! Form::label('fecha', 'Fecha', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 input-group">
          {!! Form::text('fecha', old('fecha'), ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'required', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask']) !!}
          @if ($errors->has('fecha'))
          <span class="help-block">{{ $errors->first('fecha') }}</span>
          @endif
          <span class="input-group-btn">
            <a href="#" class="btn btn-default btn-flat" id="btn_fecha"><i class="fa fa-calendar"></i></a>
          </span>
        </div>
      </div>
      <!-- Hora de entrada -->
      <div class="form-group{{ $errors->has('hora_entrada') ? ' has-error' : '' }} input-btn-alinear">
        {!! Form::label('hora_entrada', 'Hora de entrada', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 input-group">
          {!! Form::text('hora_entrada', old('hora_entrada'), ['class' => 'form-control', 'placeholder' => 'hh:mm:ss', 'required', 'data-inputmask' => '"mask": "99:99:99"', 'data-mask']) !!}
          @if ($errors->has('hora_entrada'))
          <span class="help-block">{{ $errors->first('hora_entrada') }}</span>
          @endif
          <span class="input-group-btn">
            <a href="#" class="btn btn-default btn-flat" id="btn_hora_entrada"><i class="fa fa-clock-o"></i></a>
          </span>
        </div>
      </div>
      <!-- Hora de salida -->
      <div class="form-group{{ $errors->has('hora_salida') ? ' has-error' : '' }} input-btn-alinear">
        {!! Form::label('hora_salida', 'Hora de salida', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 input-group">
          {!! Form::text('hora_salida', old('hora_salida'), ['class' => 'form-control', 'placeholder' => 'hh:mm:ss', 'data-inputmask' => '"mask": "99:99:99"', 'data-mask']) !!}
          @if ($errors->has('hora_salida'))
          <span class="help-block">{{ $errors->first('hora_salida') }}</span>
          @endif
          <span class="input-group-btn">
            <a href="#" class="btn btn-default btn-flat" id="btn_hora_salida"><i class="fa fa-clock-o"></i></a>
          </span>
        </div>
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

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.date.extensions.js') }}"></script>
<script type="text/javascript">
  $(function () {
    // Máscaras.
    $('[data-mask]').inputmask()
  })
</script>
<script type="text/javascript">
  (function () {
    // Fecha actual.
    var fechaActual = function() {
      document.getElementById("fecha").value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}";
    };
    var btn_fecha = document.getElementById('btn_fecha');
    btn_fecha.addEventListener('click', fechaActual);
    // Hora de entrada actual.
    var horaEntradaActual = function() {
      document.getElementById("hora_entrada").value="{{ \Carbon\Carbon::now()->format('H:i:s') }}";
    };
    var btn_hora_entrada = document.getElementById('btn_hora_entrada');
    btn_hora_entrada.addEventListener('click', horaEntradaActual);
    
    // Hora de salida actual.
    var horaSalidaActual = function() {
      document.getElementById("hora_salida").value="{{ \Carbon\Carbon::now()->format('H:i:s') }}";
    };
    var btn_hora_salida = document.getElementById('btn_hora_salida');
    btn_hora_salida.addEventListener('click', horaSalidaActual);
  }())
</script>
@endsection