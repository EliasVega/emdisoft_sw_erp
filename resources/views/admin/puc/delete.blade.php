<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $id }}">
    {!! Form::open(['method' => 'DELETE', 'route' => ['pucs.destroy', $id]]) !!}
    {!! Form::token() !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar cuenta del PUC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar esta cuenta del PUC de forma permanente? Esta acción no se podrá deshacer.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit">Confirmar</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>