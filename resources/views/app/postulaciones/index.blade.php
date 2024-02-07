@extends('app.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('app/css/avisos/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/plugins/daterangepicker/daterangepicker.css') }}" />
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="main">

        <div id="loading-avisos">
            <p>Cargando...</p>
        </div>

        <div class="head-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Tus Postulaciones</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row col-lg-12">

                <div class="card" >
                    <div class="row">
                        <div class="col-md-6 not-padding text-left"><small>Lorem ipsum dolor sit amet.</small></div>
                        <div class="col-md-6 not-padding text-right"><a>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, laborum.</a></div>
                        <div class="col-md-12 not-padding">
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
    
                        <div class="col-md-6 not-padding text-left">
                       {{--  @if(count($carrera) > 0)
                        @foreach($carrera as $value)
                            <small>{{ $q->solicita_carrera == $value->id ? $value->nombre : " " }}</small>
                        @endforeach
                        @endif --}}
                        </div>
                        <div class="col-md-6 not-padding text-right"><small>Públicado el </small></div>                        
                    </div>
                </div>

            </div>
        </div>

    </div>
 
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/daterangepicker/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/auth/plugins/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>const PERFIL = {{ Auth::guard('alumnos')->user() != null ? 2 : 1 }}</script>
    <script type="text/javascript" src="{{ asset('app/js/avisos/index.js') }}"></script>
@endsection

