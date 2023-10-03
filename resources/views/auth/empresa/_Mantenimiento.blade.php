<div id="modalMantenimientoEmpresa" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" action="" id="registroEmpresa" method="POST"
              data-ajax="true" data-close-modal="true" data-ajax-loading="#loading" data-ajax-success="OnSuccessRegistroEmpresa" data-ajax-failure="OnFailureRegistroEmpresa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">RUC</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->ruc : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="">Razón Social</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->razon_social : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="">Nombre Empresa</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->nombre_comercial : "" }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Ciudad</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->provincias->nombre : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="">Distrito</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->distritos->nombre : "" }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="">Dirección</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->direccion : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="">Teléfono</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->telefono : "" }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">E-mail</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->email : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="">Página Web</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->	pagina_web : "" }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nombre Contacto</label>
                                <input type="text" class="form-input" value="{{ $Entity->nombre_contacto. " " .$Entity->apellido_contacto }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="">Teléfono Contacto</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->telefono_contacto : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="">Cargo Contacto</label>
                                <input type="text" class="form-input" value="{{ $Entity->cargo_contacto }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">E-mail Contacto</label>
                                <input type="email" class="form-input" value="{{ $Entity->email_contacto }}" autocomplete="off" disabled>
                            </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
