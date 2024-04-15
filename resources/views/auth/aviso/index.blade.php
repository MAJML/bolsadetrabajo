@extends('auth.index')

@section('titulo')
    <title>BolsaTrabajo | Avisos</title>
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
                Listado Avisos
                <small>Mantenimiento</small>
            </h1>

            <ol class="breadcrumb">
                <li class="mr-10">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="empresa_filter_id" id="empresa_filter_id" class="form-input">
                                <option value="">--Todas las empresas--</option>
                                @foreach($Empresas as $q)
                                    <option value="{{ $q->id }}">{{ $q->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
            </ol>
        </section>
        <section class="content">
            @csrf
            <!-- width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed' -->
            <div class="row">
                <div class="col-md-12">
                    {{-- <table id="tableAviso" width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed'></table> --}}
                    <table id="tableAviso" width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed'></table>
                </div>
            </div>
        </section>

    </div>



@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/aviso/index.js') }}"></script>
@endsection
