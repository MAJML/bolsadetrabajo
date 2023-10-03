@extends('auth.index')

@section('titulo')
    <title>BolsaTrabajo | Empresas</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection


@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado Empleador
                <small>Mantenimiento</small>
            </h1>
        </section>

        <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <table id="tableEmpresa" width="100%" class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                    {{-- <table id="tableEmpresa" class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer"></table> --}}
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
