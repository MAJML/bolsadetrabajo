@extends('auth.index')

@section('titulo')
    <title>BolsaTrabajo | Alumnos</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection
<style type="text/css">

    .txt_claro{
        background: #79f57f63;
        /* color: #fff; */
    }
    .label-as-badge {
        border-radius: 1em;
        font-size: 12px;
        cursor: pointer;
    }
    table.dataTable th,
    table.dataTable td {
        white-space: nowrap;
    }
    .sorting_1{
        padding-left: 30px !important;
    }
</style>
@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado Estudiantes
                <small>Mantenimiento</small>
            </h1>
        </section>

        <!-- width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed' -->

        <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    {{-- <table id="tableAlumno" width="100%" class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table> --}}
                    <table id="tableAlumno" width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed'></table>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/alumno/index.js') }}"></script>
@endsection
