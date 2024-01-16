<div class="row">
    @foreach($avisos as $q)  
        <div class="col-md-6">
            {{-- {{ $q->empresas->link }} <br> --}}
            {{-- <div class="card" data-empresa="{{ $q->empresas != null ? $q->empresas->link : "-" }}" data-info="{{ $q->link }}"> --}}
            <div class="card" data-empresa="{{ $q->empresas != null ? $q->empresas->id : "-" }}" data-info="{{ $q->link }}">
                <div class="row">
                    <div class="col-md-6 not-padding text-left"><small>{{ ($q->distritos != null ? $q->distritos->nombre : "") }}</small></div>
                    <div class="col-md-6 not-padding text-right"><a>{{ $q->empresas != null ? $q->empresas->nombre_comercial : "-" }}</a></div>
                    <div class="col-md-12 not-padding">
                        <p>{{ strtoupper($q->titulo) }}</p>
                    </div>

                    
                    <div class="col-md-6 not-padding text-left">
                    @if(count($carrera) > 0)
                    @foreach($carrera as $value)
                        <small>{{ $q->solicita_carrera == $value->id ? $value->nombre : " " }}</small>
                    @endforeach
                    @endif
                    </div>
                    <div class="col-md-6 not-padding text-right"><small>Públicado el {{ \BolsaTrabajo\App::formatDateStringSpanish($q->created_at) }}</small></div>                        
                    

                </div>
            </div>
        </div>
    @endforeach
</div>