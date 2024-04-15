@extends('auth.index')

@section('titulo')
    <title>BolsaTrabajo | Empresas</title>
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
                Listado Empleador
                <small>Mantenimiento</small>
            </h1>
        </section>
        
        <ol class="breadcrumb mb-0 pb-0">
            <li class="">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select name="actividad_eco_filter_id" id="actividad_eco_filter_id" class="form-input">
                            <option value="">--Todas las Actividades Económicas--</option>
                            @foreach($actividad_eco as $q)
                                <option value="{{ $q->id }}">{{ $q->codigo.' | '.$q->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </li>
        </ol>
        <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    {{-- <table id="tableEmpresa" width="100%" class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table> --}}
                    <table id="tableEmpresa" width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed'></table>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/empresa/index.js') }}"></script>
@endsection
