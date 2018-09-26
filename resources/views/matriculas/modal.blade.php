<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $matricula->id }}">
  {!! Form::open(array('action' => array('MatriculaController@destroy', $matricula->id), 'method' => 'delete')) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Eliminar Matrícula</h4>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar el registro de la matrícula de {{ $matricula->nombre }} {{ $matricula->apellido }} en el grado {{ $matricula->codigo }}?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary btn-flat">Aceptar</button>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
</div>