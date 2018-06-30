<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-imagen">
  {!! Form::open(['route' => ['actualizar-imagen', Auth::user()->id], 'autocomplete' => 'off', 'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal']) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Cambiar imagen de perfil</h4>
        </div>
        <div class="modal-body">
          <!-- Imagen -->
          <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
            {!! Form::label('imagen', 'Imagen', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-8">
              {!! Form::file('imagen', ['class' => 'input-alinear']) !!}
              @if ($errors->has('imagen'))
                <span class="help-block">{{ $errors->first('imagen') }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancelar</button>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
</div>