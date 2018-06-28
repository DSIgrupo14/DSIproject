{!! Form::open(array('url' => 'jornadas', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search', 'class' => 'form-inline')) !!}
  <!-- Fecha -->
  <div class="form-group">
    <div class="input-group">
      {!! Form::text('searchFecha', $fecha, ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask']) !!}
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
  <!-- Barra de búsqueda -->
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" name="searchText", placeholder="Buscar", value="{{ $searchText }}"></input>
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
{!! Form::close() !!}