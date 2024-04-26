@extends('app.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('app/css/avisos/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/plugins/daterangepicker/daterangepicker.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet"> --}}
@endsection

@section('content')

    <style>
        .content_cuadros_banner{
           /*  background: #afaa0f !important; */
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-content: center;
            align-items: center;
        }
        .content_img_banner_va{
            width: 38%;
        }
        ..content_img_banner_va img{
            width: 100%;
        }
        .content_divs_banner_va{
            width: 50%;
        }
        .content_divs_banner_va .cabezera_vale{
            margin-bottom: 30px;
        }
        .container_btn_banne {
            cursor: pointer;
            position: relative;
            width: 90%;
            height: 100px;
            margin-bottom: 25px;
        }

        .content_btn_azul,
        .content_btn_celeste {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .content_btn_azul {
            background-color: #094a90;
            clip-path: polygon(100% 0, 100% 100%, 0% 100%, 12% 50%, 0% 0%);
        }

        .content_btn_celeste {
            bottom: -10%;
            left: 2%;
            background-color: #22bdff;
            clip-path: polygon(100% 0, 100% 100%, 0% 100%, 12% 50%, 0% 0%);
            text-align: center;
            padding: 10px 0px 10px 40px;
            color: #fff;
            transition: 0.3s all;
        }
        .content_btn_celeste:hover{
            background: #1a99cf;
        }

        @media only screen and (max-width: 991px) {
            .container_btn_banne {
                position: relative;
                width: 90%;
                height: 70px;
                margin-bottom: 25px;
            }
            .content_btn_celeste{
                font-size:10px;
            }
            .content_btn_celeste {
                bottom: -10%;
                left: 2%;
                padding: 10px 0px 10px 17px;
            }
        }	
        @media only screen and (max-width: 448px) {
            .container_btn_banne {
                position: relative;
                width: 100%;
                height: 100px;
                margin-bottom: 25px;
            }
            .content_btn_celeste{
                font-size:10px;
            }
            .content_btn_celeste {
                bottom: -10%;
                left: 2%;
                padding: 10px 0px 10px 17px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-content: center;
                align-items: center;
            }
        }
        .carousel-control-prev{
            margin-left:16%;
        }
        .carousel-control-next{
            margin-right:16%;
        }
        @media screen and (max-width:1669px){
            .carousel-control-prev{
                margin-left:7% !important;
            }
            .carousel-control-next{
                margin-right:7% !important;
            }
        }	
        @media screen and (max-width:1243px){
            .carousel-control-prev{
                margin-left:0% !important;
            }
            .carousel-control-next{
                margin-right:0% !important;
            }
        }	
        @media screen and (max-width:679px){
            .carousel-control-prev{
                margin-top: 90% !important
            }
            .carousel-control-next{
                margin-top: 90% !important;
            }
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
 
    <button hidden type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal3">
    </button>
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a href='javascript:void(0);'><img src='../app/img/pop de semipresencial.png' alt=''></a>
            </div>
        </div>
        </div>
    </div>

    <button hidden type="button" class="btn btn-primary btn-lg btn_evento_bolsa" data-toggle="modal" data-target="#tuto">
    </button>
    <div class="modal fade" style="background: rgba(7, 7, 7, 0.89) !important;" id="tuto" tabindex="-1" role="dialog" aria-labelledby="tuto" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" style="z-index:999; color:red !important; border:none; font-size:40px; font-weight:900;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><b>&times;</b></span></button>
                </div>
                <div class="modal-body">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="../app/img/talent_26_abril_central.png">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../app/img/talent_26_abril_mendiola.png">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../app/img/talent_29_abril.png">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../app/img/banner_tutorial.png">
                            </div>
                        </div>
                        
                    </div>
                    {{-- <a href='https://wa.me/922611913?text=Hola 😁,Deseo que me ayuden con mi CV, vengo de la bolsa de trabajo.' target='_blank'><img src='../app/img/banner_tutorial.png' alt=''></a> --}}
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span style="color:#fff; font-size:60px !important;" class="" aria-hidden="true"> ◀ </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span style="color:#fff; font-size:60px !important;" class="" aria-hidden="true"> ▶ </span>
            <span class="sr-only">Next</span>
        </a>
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
                <div class="content_cuadros_banner">
                    <div class="content_img_banner_va">
                        <img src="../app/img/banner_valeria_xd.jpeg" alt="">
                    </div>
                    <div class="content_divs_banner_va">
                        <img class="cabezera_vale" src="../app/img/banner_valeria_header.jpeg" alt="">

                        <div class="container_btn_banne" onclick="window.open('https://forms.gle/rSYqfdrMEiQwq3526', '_blank');return false;">
                            <div class="content_btn_azul"></div>
                            <div class="content_btn_celeste">
                                <span>Empresa: BOTICAS Y SALUD</span><br>
                                <span>SÁBADO 24  de Febrero 1pm</span><br>
                                <span>Sede Belisario</span>
                            </div>
                        </div>

                        <div class="container_btn_banne" onclick="window.open('https://forms.gle/5DiqZfGEPbVM8Sb47', '_blank');return false;">
                            <div class="content_btn_azul"></div>
                            <div class="content_btn_celeste">
                                <span>Empresa: KONECTA</span><br>
                                <span>MARTES 27 de Febrero 12pm</span><br>
                                <span>Sede Mendiola</span>
                            </div>
                        </div>

                        <div class="container_btn_banne" onclick="window.open('https://forms.gle/HAAEm8XZGow8qsyw6', '_blank');return false;">
                            <div class="content_btn_azul"></div>
                            <div class="content_btn_celeste">
                                <span>Empresa: InkaFarma y Mifarma</span><br>
                                <span>MARTES 27 de Febrero 12pm</span><br>
                                <span>Sede SJL 22</span>
                            </div>
                        </div>

                        <div class="container_btn_banne" onclick="window.open('https://forms.gle/NbWdPxpACf7L14wV8', '_blank');return false;">
                            <div class="content_btn_azul"></div>
                            <div class="content_btn_celeste">
                                <span>Empresa: Clinica Angloamericana</span><br>
                                <span>MARTES 27 de Febrero 11:30pm</span><br>
                                <span>Sede Central</span>
                            </div>
                        </div>

                    </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/daterangepicker/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/auth/plugins/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>const PERFIL = {{ Auth::guard('alumnos')->user() != null ? 2 : 1 }}</script>
    <script type="text/javascript" src="{{ asset('app/js/avisos/index.js') }}"></script>
@endsection
