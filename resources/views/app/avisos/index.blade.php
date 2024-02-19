@extends('app.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('app/css/avisos/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/plugins/daterangepicker/daterangepicker.css') }}" />
@endsection

@section('content')

    <style>
        .content_cuadros_banner{
            background: #0f4eaf !important;
            width: 100%;
            padding-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-content: center;
            align-items: center;
        }
        .cajita_cuadro_btn{
            width: 45%;
            background: #fff;
            color: #0049af !important;
            font-weight: 600 !important;
            margin: auto;
            margin-bottom: 30px;
            border: 1px solid #0049af;
            border-radius: 30px;
            text-align: center;
        }
        .cajita_cuadro_btn:hover{
            background: #e6e6e6;
        }
    </style>

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="main">

        <div id="loading-avisos">
            <p>Cargando...</p>
        </div>

        <div class="head-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form">
                            <input type="text" id="name" name="name" class="form-input" placeholder="Puesto o palabra clave">
                            <button type="button" class="filterSearch">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-3 filter-cont">
                    <div class="filter">
                        <form action="">
                            @if(Auth::guard('empresasw')->check())
                                <a href="{{ route('empresa.registrar_aviso') }}" class="button" >Nueva oportunidad</a>
                                <a href="{{ route('empresa.listar_aviso') }}" class="button" >Mis oportunidades</a>
                            @endif
                            <h5>Filtros</h5>
                            <div class="form-content">
                                <div class="form-group">
                                    <div id="reportrange" class="text-capitalize" style="">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <select name="area_filter_id" id="area_filter_id" class="form-input" required>
                                        <option value=""></option>
                                    @foreach($areas as $a)
                                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                    @endforeach
                                    </select>
                                    <label for="area_filter_id">Carrera</label>
                                </div>
                                <div class="form-group">
                                    <select name="provincia_filter_idd" id="provincia_filter_idd" class="form-input" required>
                                        <option value=""></option>
                                        @foreach($provincias as $a)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label for="provincia_filter_id">Ciudad</label>
                                </div>
                                <div class="form-group">
                                    <select name="distrito_filter_id" id="distrito_filter_id" class="form-input" required>
                                        <option value=""></option>
                                    </select>
                                    <label for="distrito_filter_id">Distrito</label>
                                </div>

                                
                                <div class="form-group" hidden>
                                    <select name="horario_filter_id" id="horario_filter_id" class="form-input" required>
                                        <option value=""></option>
                                        @foreach($horarios as $a)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label for="horario_filter_id">Tipo de puesto</label>
                                </div>
                                <div class="form-group" hidden>
                                    <select name="modalidad_filter_id" id="modalidad_filter_id" class="form-input" required>
                                        <option value=""></option>
                                        @foreach($modalidades as $a)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label for="modalidad_filter_id">Modalidad</label>
                                </div>
                                <!--<div class="form-group">
                                    <input type="text" class="form-input decimal" required>
                                    <label for="sueldo">Sueldo</label>
                                </div>-->
                            </div>
                        </form>
                    </div>
                </div>

                <div id="avisos" class="col-md-7 not-padding">
                    <div id="cards-list" class="content avisos endless-pagination" data-next-page></div>
                </div>

                <div id="aviso-informacion hidden"></div>

                <div class="col-md-2 text-center">
                    <a href="https://wa.me/922611913?text=Hola, Vengo de la Bolsa de trabajo y quiero conocer más sobre los programas de empleabilidad. Información por favor 😊" target="_blank">
                        <img src="{{ asset('app/img/banner2_janet.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

    </div>
 
    <button hidden type="button" class="btn btn-primary btn-lg btn_evento_bolsa" data-toggle="modal" data-target="#modal3">
    </button>
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a href='https://forms.gle/kxF91An5nBd7yEkH9' target='blank'><img src='../app/img/ferreyros_banner.png' alt=''></a>
            </div>
        </div>
        </div>
    </div>

    <button hidden type="button" class="btn btn-primary btn-lg btn_evento_bolsa" data-toggle="modal" data-target="#tuto">
    </button>
    <div class="modal fade" id="tuto" tabindex="-1" role="dialog" aria-labelledby="tuto">
        <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #0049af;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a href='https://wa.me/922611913?text=Hola 😁,Deseo que me ayuden con mi CV, vengo de la bolsa de trabajo.' target='_blank'><img src='../app/img/banner_tutorial.png' alt=''></a>
            </div>
        </div>
        </div>
    </div>

    <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    </button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a href='javascript:void(0)' ><img src='../app/img/banner_insercion_recortado.jpg' alt=''></a><br>
                <div class="content_cuadros_banner">
                    <button onclick="window.open('https://forms.gle/kiHhRc8kRjryDS4W8', '_blank');return false;" class="cajita_cuadro_btn">
                        <span>SEDE CENTRAL 16/02 1:00PM</span><br>
                        <span>FARMACIAS PERUANAS</span><br>
                        <span>977 761 677</span>
                    </button>
                    <button onclick="window.open('https://forms.gle/9FH6WDSb3Ssk4S9WA', '_blank');return false;" class="cajita_cuadro_btn">
                        <span>SEDE MENDIOLA 16/02 12:00PM</span><br>
                        <span>WEBHELLP</span><br>
                        <span>948 536 558</span>
                    </button>
                    <button onclick="window.open('https://forms.gle/3MqsXu44AU35fL1G8', '_blank');return false;" class="cajita_cuadro_btn">
                        <span>SEDE CENTRAL 19/02 12:00PM</span><br>
                        <span>MEGABOTIKAS</span><br>
                        <span>922 762 489</span>
                    </button>
                    <button onclick="window.open('https://forms.gle/Xv5E5VkU8nPMeiK48', '_blank');return false;" class="cajita_cuadro_btn">
                        <span>SEDE BILLINGURSTH 23/02 1:00PM</span><br>
                        <span>FARMACIAS PERUANAS</span><br>
                        <span>948 536 664</span>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>




    <script>
        /* Swal.fire({
            title: "<a href='' target='blank'><img src='../app/img/new_evento_vale.jpeg' alt=''></a>",
            width: "800px",
            padding: "0px",
            background: "#ffffff00",
            imageWidth: 700,
            imageAlt: 'Custom image',
            showConfirmButton: false
        }) */
    </script>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/daterangepicker/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/auth/plugins/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>const PERFIL = {{ Auth::guard('alumnos')->user() != null ? 2 : 1 }}</script>
    <script type="text/javascript" src="{{ asset('app/js/avisos/index.js') }}"></script>
@endsection

