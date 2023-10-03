@extends('app.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('app/css/avisos/index.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/datepicker/datepicker3.css') }}">
    <style type="text/css">
        .hidden{ display: none !important;}
    </style>
@endsection

@section('content')

    <div id="main">

        <div id="loading-avisos">
            <p>Cargando...</p>
        </div>

        <div class="head-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Crear mi cuenta</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-3 filter-cont">
                    <div class="filter"></div>
                </div>
                <div class="col-md-7">
                    <form enctype="multipart/form-data" action="{{ route('alumno.registrar_alumno.post') }}" class="formulario" method="post">
                        @csrf
                        <div class="card aviso">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" class="form-input {{ $errors->has('nombres') ? ' is-invalid' : '' }}" value="{{ old('nombres') }}" name="nombres" id="nombres"  placeholder="Nombres" required>
                                    @if ($errors->has('nombres'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombres') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-input {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" value="{{ old('apellidos') }}"  name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                    @if ($errors->has('apellidos'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apellidos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" class="form-input {{ $errors->has('telefono') ? ' is-invalid' : '' }}"  value="{{ old('telefono') }}"   name="telefono" id="telefono" minlength="9" maxlength="9" onkeypress="return isNumberKey(event)" placeholder="Teléfono" required>
                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-input border border-dark {{ $errors->has('dni') ? ' is-invalid' : '' }}" value="{{ old('dni') }}" name="dni" id="dni" onkeypress="return isNumberKey(event)" placeholder="DNI" required>
                                    <small id="validationDni" class="form-text text-muted">
                                        Ingrese su dni para autocompletar su información.
                                    </small>
                                    @if ($errors->has('dni'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dni') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="email" class="form-input {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="Correo electrónico" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-input {{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento')}}" placeholder="Fecha de Nacimiento" autocomplete="off" required>
                                    @if ($errors->has('fecha_nacimiento'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select name="provincia_id" id="provincia_id" class="form-input {{ $errors->has('provincia_id') ? ' is-invalid' : '' }}" required>
                                        <option value="">Departamento</option>
                                        @foreach($Provincias as $q)
                                            <option value="{{ $q->id }}">{{ $q->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('provincia_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('provincia_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <select name="distrito_id" id="distrito_id" class="form-input {{ $errors->has('distrito_id') ? ' is-invalid' : '' }}" required>
                                        <option value="">Distrito</option>
                                    </select>
                                    @if ($errors->has('distrito_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('distrito_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select name="area_id" id="area_id" class="form-input {{ $errors->has('area_id') ? ' is-invalid' : '' }}" required>
                                        <option value="">Programa de estudios</option>
                                        @foreach($Areas as $q)
                                            <option value="{{ $q->id }}">{{ $q->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('area_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('area_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <select name="egresado" id="egresado" class="form-input" required>
                                        <option value="">Grado académico</option>
                                        <option value="0">Estudiante</option>
                                        <option value="1">Egresado</option>
                                        <option value="2">Titulado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card aviso mt-2">
                            <button id="btn-registrar" disabled type="submit">Registrar</button>
                            <a href="{{ route('index') }}" class="text-uppercase">Regresar</a>
                        </div>
                    </form>
                </div>

                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)">
                        <img src="{{ asset('app/img/banner-cv.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

    </div>

    <style>
        button{
            cursor : pointer
        }
        button:disabled,
        button[disabled]{
            opacity:  0.3;
            cursor : default
        }
    </style>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('app/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/plugins/datepicker/bootstrap-datepicker.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/js/alumno/registrar.js') }}"></script>
@endsection

