<div id="modalMantenimientoHorario" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form enctype="multipart/form-data" action="{{ route('auth.horario.store') }}" id="registroHorario" method="POST"
              data-ajax="true" data-close-modal="true" data-ajax-loading="#loading" data-ajax-success="OnSuccessRegistroHorario" data-ajax-failure="OnFailureRegistroHorario">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? "Modificar" : " Registrar" }} Horario</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-input" name="nombre" value="{{ $Entity != null ? $Entity->nombre : "" }}" id="nombre" autocomplete="off" required>
                                <span data-valmsg-for="nombre"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? "Modificar" : " Registrar" }} Horario</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/horario/_Mantenimiento.min.js') }}"></script>
