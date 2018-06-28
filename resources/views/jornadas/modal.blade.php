<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $jornada->id }}">
  {!! Form::open(array('action' => array('JornadaController@destroy', $jornada->id), 'method' => 'delete')) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Eliminar Jornada Laboral</h4>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar el registro de la jornada laboral de {{ $jornada->nombre }} {{ $jornada->apellido }}?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary btn-flat">Aceptar</button>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
</div>