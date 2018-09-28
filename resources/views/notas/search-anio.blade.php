{!! Form::open(array('url' => 'notas', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search', 'class' => 'form-inline')) !!}
  <!-- Año -->
  <div class="form-group">
    <div class="input-group">
      {!! Form::select('anio_search', $anios, $anio->id, ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un año --']) !!}
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
{!! Form::close() !!}