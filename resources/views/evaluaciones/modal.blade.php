<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $evaluacion->id }}">
  {!! Form::open(array('action' => array('EvaluacionController@destroy', $evaluacion->id), 'method' => 'get')) !!}
    {!! Form::hidden('gra_mat', $gra_mat, ['required']) !!}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Eliminación de Evaluación</h4>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar esta evaluación?</p>
          <p>Al hacerlo se eliminaran todas las notas asociadas a esta evaluación.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary btn-flat">Aceptar</button>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
</div>