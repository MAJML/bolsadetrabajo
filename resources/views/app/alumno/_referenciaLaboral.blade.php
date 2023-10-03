<div id="modalMantenimientoReferenciaLaboral" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('alumno.perfil.referencia_store') }}" id="registroReferenciaLaboral" method="POST"
              data-ajax="true" data-close-modal="true" data-ajax-loading="#loading" data-ajax-success="OnSuccessRegistroReferenciaLaboral" data-ajax-failure="OnFailureRegistroReferenciaLaboral">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Referencia != null ? "Modificar" : "Registrar" }} Cursos, Talleres</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Referencia != null ? $Referencia->id : 0 }}">

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <input type="text" value="{{ $Referencia != null ? $Referencia->institucion : "" }}" class="form-input" name="institucion" placeholder="Nombre de la Institución" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" value="{{ $Referencia != null ? $Referencia->name_curso : "" }}" class="form-input" name="name_curso" placeholder="Nombre del Curso" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" value="{{ $Referencia != null ? $Referencia->inicio_curso : "" }}" class="form-input" name="inicio_curso" placeholder="Inicio del Curso" onfocus="(this.type = 'month')" onblur="(this.type='text')" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" value="{{ $Referencia != null ? $Referencia->fin_curso : "" }}" class="form-input" name="fin_curso" placeholder="Fin del Curso" onfocus="(this.type = 'month')" onblur="(this.type='text')" required>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">{{ $Referencia != null ? "Modificar" : "Registrar" }} Cursos, Talleres</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('app/js/alumno/_referenciaLaboral.min.js') }}"></script>
