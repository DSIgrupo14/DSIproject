{!! Form::open(['route' => ['pagos.store2', $pago->id], 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-inline']) !!}
<!-- Alumno -->
<div class="form-group{{ $errors->has('alumno_id') ? ' has-error' : '' }}">
  {!! Form::label('alumno_id', 'Alumno', ['class' => 'control-label']) !!}
  &nbsp;
  {!! Form::select('alumno_id', $alumnos, old('alumno_id'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un alumno --', 'required']) !!}
  @if ($errors->has('alumno_id'))
  <span class="help-block">{{ $errors->first('alumno_id') }}</span>
  @endif
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- Pago -->
<div class="form-group{{ $errors->has('pago') ? ' has-error' : '' }}">
  {!! Form::label('pago', 'Pago', ['class' => 'control-label']) !!}
  &nbsp;
  {!! Form::text('pago', old('pago'), ['class' => 'form-control', 'placeholder' => 'Pago', 'required']) !!}
  @if ($errors->has('pago'))
  <span class="help-block">{{ $errors->first('pago') }}</span>
  @endif
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{!! Form::submit('Registrar', ['class' => 'btn btn-primary btn-flat']) !!}
{!! Form::close() !!}