@extends('layouts.app')

@section('titulo', 'Ingresar Encuestas ADS')
    @section('contenido')

    <div class="card col-lg-12 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Ingresar Encuestas ADS</h3>
        </div>
        <div id="data-tag-servicio-id" data-data="{{$servicio->id}}"></div>
        <div id="data-tag-encuestas" data-data="{{$encuestas}}"></div>
        <div id="data-tag-etapa" data-data="{{ $servicio->get_last_etapa()->id }}"></div>
        <div class="card-body">

            {{-- {{$encuestas}} --}}

            <div class="row">
                <div class="col-md-12">
                    <div id="error-datos" hidden>
                        <div id="mensaje-error-datos" class="alert alert-danger" role="alert">
                            <div id="validacion-valor" hidden>- Alguno de los valores ingresados no es válido.</div>
                            <div id="validacion-valor-ingresado" hidden>- Se debe ingresar todos los valores de la fila.</div>
                        </div>
                    </div>
                    <div id="encuestas"></div>
                    <div id="guardando-datos" style="margin-top:1rem;" class="text-right" hidden>
                        <button type="button" class="btn btn-secondary btn-loading">C</button>Guardando
                    </div>
                    <div id="error-guardar-datos" style="margin-top:1rem;" class="text-center" hidden>
                        <div class="alert alert-danger" role="alert">
                            No se pudo guardar los cambios.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6 col-sm-6">
                <a href="/servicio/checklist/{{$servicio->id}}" class="btn btn-secondary">Volver</a>
            </div>
            <div class="col-md-6 col-sm-6 text-right">
                <button id="btn-guardar" type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
        <script src="/components/handsontable/dist/handsontable.full.min.js"></script>
        <script src="/js/servicio/ingresar_encuestas_ads.js"></script>
    @endsection

    @section('styles')
        <link rel="stylesheet" href="/components/handsontable/dist/handsontable.full.min.css">
    @endsection