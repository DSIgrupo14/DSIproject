{!! Form::open(array('url' => 'notas.edit', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search', 'class' => 'form-inline')) !!}
  <!-- Trimestre -->
  <div class="form-group">
    <div class="input-group">
      {!! Form::select('trimestre', ['1' => '1', '2' => '2', '3' => '3'], old('trimestre'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un trimestre --', 'required'] ) !!}
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
{!! Form::close() !!}