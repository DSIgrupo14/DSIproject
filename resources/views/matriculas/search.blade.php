{!! Form::open(array('url' => 'matriculas', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search', 'class' => 'form-inline')) !!}
  <!-- Grado -->
  <div class="form-group">
    {!! Form::select('searchGrado', $grados, $grado, ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un grado --']) !!}
  </div>
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