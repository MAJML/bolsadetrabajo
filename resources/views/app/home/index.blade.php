@extends('app.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('app/css/home/index.css') }}">
@endsection

@section('content')
    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* .caja_formularios{
            display: flex;
        }
        .caja_form_empleo{
            order: 2 !important;
        }
        .caja_form_empleo{
            order: 1 !important;
        } */
    </style>

    <div id="main">
        <div class="banner-header">
            <img src="{{ asset('app/img/bolsa-de-trabajo_azul_oscuro.jpg') }}" class="img-fluid" alt="Bolsa Laboral">
        </div>
        <div class="auth-forms">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="{{ route('alumno.login.post') }}" method="post" class="assign">
                            @csrf
                            <h5>Aplicar a un empleo</h5>
                            <div class="form-group">
                                <input type="text" id="usuario_alumno" name="usuario_alumno" class="form-input {{ $errors->has('usuario_alumno') ? ' is-invalid' : '' }}" value="{{ old('usuario_alumno') }}" required>
                                <label for="usuario_alumno">Usuario</label>
                                @if ($errors->has('usuario_alumno'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('usuario_alumno') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="password_alumno" name="password" class="form-input {{ $errors->has('password_alumno') ? ' is-invalid' : '' }}" required>
                                <label for="password_alumno">Contraseña</label>
                                @if ($errors->has('password_alumno'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_alumno') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit">Ingresar</button>
                            <a href="{{ route('alumno.crear_alumno') }}" class="text-uppercase">Solicitar acceso</a>
                        </form>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="{{ route('empresa.login.post') }}" method="post" class="publish">
                            @csrf
                            <h5>Publicar una oferta</h5>
                            <div class="form-group">
                                <input type="text" id="usuario_empresa" name="usuario_empresa" class="form-input {{ $errors->has('usuario_empresa') ? ' is-invalid' : '' }}" value="{{ old('usuario_empresa') }}" required>
                                <label for="usuario_empresa">Usuario</label>
                                @if ($errors->has('usuario_empresa'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('usuario_empresa') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="password_empresa" name="password" class="form-input {{ $errors->has('password_empresa') ? ' is-invalid' : '' }}" required>
                                <label for="password_empresa">Contraseña</label>
                                @if ($errors->has('password_empresa'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_empresa') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit">Ingresar</button>
                            <a href="{{ route('empresa.crear_empresa') }}" class="text-uppercase">Crear una cuenta</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div></div>
    </div>
    <script>
        Swal.fire({
            title: "<a href='https://forms.gle/mnBsMA29rWZrwJjQ8' target='blank'><img src='app/img/evento_bolsa.jpeg' alt=''></a>",
            width: "800px",
            padding: "0px",
            background: "#ffffff00",
            imageWidth: 700,
            imageAlt: 'Custom image',
            showConfirmButton: false
        })
    </script>
@endsection
