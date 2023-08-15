<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Archivos del Checklist</label>
            @foreach ($servicio->get_documentos_checklist_tipo(4) as $file)
                <div class="row">
                    <div class="col-md-6">
                        <label>{{$file->file_name}}</label>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-teal btn-sm" href="/servicio/descargar_archivo_otros/{{$file->hash_file_name}}/{{$file->file_name}}" title="Descargar"><i class="fas fa-file-download"></i></a>
                        @if ($servicio->get_last_etapa()->id == 6)
                            <button class="btn btn-indigo btn-sm" onclick="eliminarArchivo({{$file->id}});" title="Eliminar" disabled><i class="fas fa-trash-alt"></i></button>
                        @else
                            <button class="btn btn-indigo btn-sm" onclick="eliminarArchivo({{$file->id}});" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="custom-file">
                <input id="archivo-4" type="file" onchange="enviarDatosArchivo('{{$servicio->id}}',4)" class="custom-file-input" multiple >
                <label id="archivo-4-text" class="custom-file-label" for="archivo-4">Seleccionar archivo...</label>
                <div id="archivo-4-alert" class="invalid-feedback">Se debe seleccionar un archivo de tipo doc, docx, xls, xlsx, ppt, pptx, png, jpeg, jpg o pdf de tamaño máximo 5 mb.</div>
            </div>
            <div id="archivos"></div>
        </div>
    </div>
</div>