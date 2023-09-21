<!--Inicio del modal Cambiar Estado-->
<div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Estado de la Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('category.destroy','test')}}" method="post" class="form-horizontal">
                    {{method_field('delete')}}
                    {!!Form::token()!!}
                    <input type="hidden" id="id" name="id" value="">
                    <p>Estas seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-lock"></i>Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal-->
