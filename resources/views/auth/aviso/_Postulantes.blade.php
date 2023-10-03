<style>
button {
  margin-left: 15px;
  background-color: #47a386;
  border: 0;
  border-radius: 3px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  color: #fff;
  font-size: 14px;
  padding: 6px 20px;
}
.modal-container {
  display: flex;
  background-color: rgba(0, 0, 0, 0.3);
  align-items: center;
  justify-content: center;
  position: fixed;
  pointer-events: none;
  opacity: 0;  
  top: 0;
  left: 0;
  height: 100%;
  width: 100%; 
  transition: opacity 0.3s ease;
  z-index: 9999;
}

.show {
  pointer-events: auto;
  opacity: 1;
}

.modal1 {
  background-color: #fff;
  width: 600px;
  max-width: 100%;
  padding: 30px 50px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  text-align: center;
}

.modal1 h1 {
  margin: 0;
}

.modal1 p {
  opacity: 0.7;
  font-size: 14px;
}

</style>


<div id="modalMantenimientoPostulante" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Listado de Postulante</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        
            <div class="modal-body">
                {{-- {{ $datito }} --}}
                <input type="hidden" id="id" name="id" value="{{ $id }}">
                <h4 class="text-center">Listado por Sistema</h4>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tablePostulante" class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer"></table>
                    </div>
                </div>

                <br><hr><hr><br>
                <h4 class="text-center">Listado Manual</h4>
                <button id="open">
                    Registrar Postulante para esta Oferta Laboral
                </button>
                <div id="modal_container" class="modal-container">
                    <div class="modal1">
                      <h4 class="mb-5">Registrar Postulante para este Oferta Laboral</h4>
                    <form action="{{ route('auth.aviso.store_estudiante_aviso') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" id="id_estudiante_aviso" name="id_estudiante_aviso" value="{{ $id }}">
                            <div class="col-md-12 mt-2">
                                <input type="text" autocomplete="off" class="form-control" name="nombres_apellido" placeholder="Nombres y Apellidos del postulante" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="text" autocomplete="off" class="form-control" name="dni" minlength="8" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  placeholder="DNI" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="text" autocomplete="off" class="form-control" name="celular" minlength="9" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  placeholder="Numero de celular" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="email" autocomplete="off" class="form-control" name="correo" placeholder="Correo Electronico" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <select name="grado_academico" class="form-control" id="" required>
                                    <option value="">Grado Académico</option>
                                    <option value="Estudiante">Estudiante</option>
                                    <option value="Egresado">Egresado</option>
                                    <option value="Titulado">Titulado</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <select name="estado" class="form-control" id="" required>
                                    <option value="">Estado</option>
                                    <option value="Postulante">Postulante</option>
                                    <option value="Evaluado">Evaluado</option>
                                    <option value="Aceptado">Aceptado</option>
                                    <option value="Descartado">Descartado</option>
                                </select>
                            </div>
                        </div>     
                        <div class="form-group row">
                            <a href="javascript:void(0)" id="close" class="btn btn-secondary">Cerrar</a>
                            <button type="submit" class="btn btn-success mx-5">Registrar</button>
                        </div>                   
                    </form>

                      

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="tablePostulanteEstudiante" class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript" src="{{ asset('auth/js/aviso/_postulantes.js') }}"></script>

