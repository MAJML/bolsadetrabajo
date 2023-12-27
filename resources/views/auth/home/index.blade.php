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
