<?php
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\OticController;
use App\Http\Controllers\ContactoEmpresaController;
use App\Http\Controllers\ContactoOticController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TematicaController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\ProyectorController;
use App\Http\Controllers\RelatorController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PendonController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\OrdenCompraController;


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('usuario')
    ->middleware(['auth', 'roles:Administrador de Usuarios'])
    ->group(function () {

    // Considerando que se está usando Route Model Binding
    Route::get('create', [UsuarioController::class, 'create'])->name('usuario.create');
    Route::post('store', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('show/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
    Route::get('edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::post('update/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::get('cambiar_password/{usuario}', [UsuarioController::class, 'cambiarPassword'])->name('usuario.cambiar_password');
    Route::post('actualizar_password/{usuario}', [UsuarioController::class, 'actualizarPassword'])->name('usuario.actualizar_password');
    Route::post('destroy', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
    Route::get('/', [UsuarioController::class, 'index'])->name('usuario.index');

    // Rutas de notificación sin middleware 'roles'
    Route::middleware([])->group(function () {
        Route::post('leer_notificacion', [UsuarioController::class, 'leerNotificacion'])->name('usuario.leer_notificacion');
        Route::post('leer_varias_notificaciones', [UsuarioController::class, 'leerVariasNotificaciones'])->name('usuario.leer_varias_notificaciones');
        Route::post('leer_todas_notificaciones', [UsuarioController::class, 'leerTodasNotificaciones'])->name('usuario.leer_todas_notificaciones');
        Route::post('destroy_notificacion', [UsuarioController::class, 'destroyNotificacion'])->name('usuario.destroy_notificacion');
        Route::get('notificaciones/{usuario}', [UsuarioController::class, 'mostrarNotificaciones'])->name('usuario.notificaciones');
    });

});

Route::prefix('empresa')
    ->middleware(['auth'])
    ->group(function () {

    Route::middleware(['roles:Gestor de Empresas'])->group(function () {
        Route::get('create', [EmpresaController::class, 'create'])->name('empresa.create');
        Route::post('store', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('edit/{id}', [EmpresaController::class, 'edit'])->name('empresa.edit');
        Route::post('update/{id}', [EmpresaController::class, 'update'])->name('empresa.update');
        Route::post('destroy', [EmpresaController::class, 'destroy'])->name('empresa.destroy');
    });

    Route::middleware(['roles:Gestor de Empresas,Gestor de Ventas'])->group(function () {
        Route::get('/', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::get('show/{id}', [EmpresaController::class, 'show'])->name('empresa.show');
    });

});

Route::prefix('otic')
    ->middleware(['auth', 'roles:Gestor de Empresas'])
    ->group(function () {

    Route::get('create', [OticController::class, 'create'])->name('otic.create');
    Route::post('store', [OticController::class, 'store'])->name('otic.store');
    Route::get('edit/{id}', [OticController::class, 'edit'])->name('otic.edit');
    Route::post('update/{id}', [OticController::class, 'update'])->name('otic.update');
    Route::get('/', [OticController::class, 'index'])->name('otic.index');
    Route::get('show/{id}', [OticController::class, 'show'])->name('otic.show');
    Route::post('destroy', [OticController::class, 'destroy'])->name('otic.destroy');

});

Route::prefix('contacto_empresa')
    ->middleware(['auth', 'roles:Gestor de Empresas'])
    ->group(function () {

    Route::get('create', [ContactoEmpresaController::class, 'create'])->name('contacto_empresa.create');
    Route::post('store', [ContactoEmpresaController::class, 'store'])->name('contacto_empresa.store');
    Route::get('edit/{id}', [ContactoEmpresaController::class, 'edit'])->name('contacto_empresa.edit');
    Route::post('update/{id}', [ContactoEmpresaController::class, 'update'])->name('contacto_empresa.update');
    Route::get('/', [ContactoEmpresaController::class, 'index'])->name('contacto_empresa.index');
    
    // Middleware adicional para múltiples roles en la ruta 'show'
    Route::get('show/{id}', [ContactoEmpresaController::class, 'show'])->middleware('roles:Gestor de Empresas,Gestor de Servicios,Gestor de Ventas')->name('contacto_empresa.show');
    Route::post('destroy', [ContactoEmpresaController::class, 'destroy'])->name('contacto_empresa.destroy');

});

Route::prefix('contacto_otic')
    ->middleware(['auth', 'roles:Gestor de Empresas'])
    ->group(function () {

    Route::get('create', [ContactoOticController::class, 'create'])->name('contacto_otic.create');
    Route::post('store', [ContactoOticController::class, 'store'])->name('contacto_otic.store');
    Route::get('edit/{id}', [ContactoOticController::class, 'edit'])->name('contacto_otic.edit');
    Route::post('update/{id}', [ContactoOticController::class, 'update'])->name('contacto_otic.update');
    Route::get('/', [ContactoOticController::class, 'index'])->name('contacto_otic.index');
    
    // Middleware adicional para múltiples roles en la ruta 'show'
    Route::get('show/{id}', [ContactoOticController::class, 'show'])->middleware('roles:Gestor de Empresas,Gestor de Servicios,Gestor de Ventas')->name('contacto_otic.show');
    Route::post('destroy', [ContactoOticController::class, 'destroy'])->name('contacto_otic.destroy');

});

Route::prefix('propuesta')
    ->middleware(['auth', 'roles:Gestor de Ventas'])
    ->group(function () {

    Route::get('create', [PropuestaController::class, 'create'])->name('propuesta.create');
    Route::post('store', [PropuestaController::class, 'store'])->name('propuesta.store');
    Route::post('guardar_archivos/{id}', [PropuestaController::class, 'guardarArchivos'])->name('propuesta.guardar_archivos');
    Route::get('show/{id}', [PropuestaController::class, 'show'])->name('propuesta.show');
    Route::get('edit/{id}', [PropuestaController::class, 'edit'])->name('propuesta.edit');
    Route::post('update/{id}', [PropuestaController::class, 'update'])->name('propuesta.update');
    Route::get('/', [PropuestaController::class, 'index'])->name('propuesta.index');
    Route::post('destroy', [PropuestaController::class, 'destroy'])->name('propuesta.destroy');
    Route::post('cursos_programa', [PropuestaController::class, 'getCursosPrograma'])->name('propuesta.cursos_programa');
    Route::get('show/descargar_archivo/{hash_file_name}/{file_name}', [PropuestaController::class, 'descargarArchivo'])->name('propuesta.descargarArchivo');
    Route::get('edit/descargar_archivo/{hash_file_name}/{file_name}', [PropuestaController::class, 'descargarArchivo'])->name('propuesta.descargar_archivo');
    Route::post('eliminar_archivo', [PropuestaController::class, 'eliminarArchivo'])->name('propuesta.eliminar_archivo');
    Route::post('cambiar_estado', [PropuestaController::class, 'cambiarEstado'])->name('propuesta.cambiar_estado');
    Route::post('contactos_empresa', [PropuestaController::class, 'getContactosEmpresaFiltrado'])->name('propuesta.contactos_empresa');
    Route::get('crear_servicios/{id}', [PropuestaController::class, 'crearServicios'])->name('propuesta.crear_servicios');
    Route::post('guardar_servicios', [PropuestaController::class, 'guardarServicios'])->name('propuesta.guardar_servicios');

    // Mantuve la siguiente ruta comentada, tal como estaba en el original:
    // Route::get('obtener_servicios/{propuestaId}', [PropuestaController::class, 'obtenerServicios'])->name('propuesta.obtener_servicios');

});

Route::prefix('curso')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [CursoController::class, 'create'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.create');

    Route::post('store', [CursoController::class, 'store'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.store');

    Route::post('store_archivo/{id}', [CursoController::class, 'storeArchivo'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.store_archivo');

    Route::get('edit/{id}', [CursoController::class, 'edit'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.edit');

    Route::post('update/{id}', [CursoController::class, 'update'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.update');

    Route::post('update_archivo/{id}', [CursoController::class, 'updateArchivo'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.update_archivo');

    Route::get('/', [CursoController::class, 'index'])
        ->middleware('roles:Gestor de Cursos,Diseñador Técnico')
        ->name('curso.index');

    Route::get('show/{id}', [CursoController::class, 'show'])
        ->middleware('roles:Gestor de Cursos,Diseñador Técnico')
        ->name('curso.show');

    // Mantuve la siguiente ruta comentada, tal como estaba en el original:
    // Route::post('destroy', [CursoController::class, 'destroy'])
    //     ->middleware('roles:Gestor de Cursos')
    //     ->name('curso.destroy');

    Route::get('show/download/{id}', [CursoController::class, 'download'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.show_download');  // Cambio en el nombre para evitar duplicidad

    Route::get('edit/download/{id}', [CursoController::class, 'download'])
        ->middleware('roles:Gestor de Cursos')
        ->name('curso.edit_download');  // Cambio en el nombre para evitar duplicidad

});

Route::prefix('tematica')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [TematicaController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.create');

    Route::post('store', [TematicaController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.store');

    Route::get('edit/{id}', [TematicaController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.edit');

    Route::post('update/{id}', [TematicaController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.update');

    Route::get('/', [TematicaController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.index');

    Route::post('destroy', [TematicaController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('tematica.destroy');

});

//Revisar
Route::prefix('metas_venta')
    ->middleware('auth')
    ->group(function () {

    Route::get('create_meta/{id}', [EmpresaController::class, 'createMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.create');

    Route::post('store_meta/{id}', [EmpresaController::class, 'storeMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.store');

    Route::get('edit_meta/{id}', [EmpresaController::class, 'editMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.edit');

    Route::post('update_meta/{id}', [EmpresaController::class, 'updateMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.update');

    Route::get('{id}', [EmpresaController::class, 'indexMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.index');

    Route::post('destroy_meta', [EmpresaController::class, 'destroyMeta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('empresa.metas_venta.destroy');

}); 

Route::prefix('programa')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [ProgramaController::class, 'create'])
        ->middleware('roles:Gestor de Cursos')
        ->name('programa.create');

    Route::post('store', [ProgramaController::class, 'store'])
        ->middleware('roles:Gestor de Cursos')
        ->name('programa.store');

    Route::get('edit/{id}', [ProgramaController::class, 'edit'])
        ->middleware('roles:Gestor de Cursos')
        ->name('programa.edit');

    Route::post('update/{id}', [ProgramaController::class, 'update'])
        ->middleware('roles:Gestor de Cursos')
        ->name('programa.update');

    Route::get('/', [ProgramaController::class, 'index'])
        ->middleware('roles:Gestor de Cursos,Diseñador Técnico')
        ->name('programa.index');

    Route::get('show/{id}', [ProgramaController::class, 'show'])
        ->middleware('roles:Gestor de Cursos,Diseñador Técnico')
        ->name('programa.show');

});

Route::prefix('notebook')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [NotebookController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.create');

    Route::post('store', [NotebookController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.store');

    Route::get('edit/{id}', [NotebookController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.edit');

    Route::post('update/{id}', [NotebookController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.update');

    Route::get('/', [NotebookController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.index');

    Route::post('destroy', [NotebookController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.destroy');

    // Gestionar archivo
    Route::get('download/{id}', [NotebookController::class, 'download'])
        ->middleware('roles:Gestor de Recursos,Gestor de Servicios')
        ->name('notebook.download');

    Route::post('store_archivo/{id}', [NotebookController::class, 'storeArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.store_archivo');

    Route::post('update_archivo/{id}', [NotebookController::class, 'updateArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('notebook.update_archivo');

});

Route::prefix('proyector')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [ProyectorController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.create');

    Route::post('store', [ProyectorController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.store');

    Route::get('edit/{id}', [ProyectorController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.edit');

    Route::post('update/{id}', [ProyectorController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.update');

    Route::get('/', [ProyectorController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.index');

    Route::post('destroy', [ProyectorController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.destroy');

    // Gestionar archivo
    Route::get('download/{id}', [ProyectorController::class, 'download'])
        ->middleware('roles:Gestor de Recursos,Gestor de Servicios')
        ->name('proyector.download');

    Route::post('store_archivo/{id}', [ProyectorController::class, 'storeArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.store_archivo');

    Route::post('update_archivo/{id}', [ProyectorController::class, 'updateArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('proyector.update_archivo');

});

Route::prefix('relator')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [RelatorController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.create');

    Route::post('store', [RelatorController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.store');

    Route::get('edit/{id}', [RelatorController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.edit');

    Route::post('update/{id}', [RelatorController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.update');

    Route::get('/', [RelatorController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.index');

    Route::post('destroy', [RelatorController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.destroy');

    Route::get('show/{id}', [RelatorController::class, 'show'])
        ->middleware('roles:Gestor de Recursos,Gestor de Servicios,Diseñador Técnico')
        ->name('relator.show');

    // Gestionar archivos
    Route::post('guardar_archivos/{id}', [RelatorController::class, 'guardarArchivos'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.guardar_archivos');

    Route::get('descargar_archivo/{hash_file_name}/{file_name}', [RelatorController::class, 'descargarArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.descargar_archivo');

    Route::post('eliminar_archivo', [RelatorController::class, 'eliminarArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('relator.eliminar_archivo');

});

Route::prefix('documento')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [DocumentoController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.create');

    Route::post('store', [DocumentoController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.store');

    Route::get('edit/{id}', [DocumentoController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.edit');

    Route::post('update/{id}', [DocumentoController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.update');

    Route::get('/', [DocumentoController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.index');

    Route::get('show/{id}', [DocumentoController::class, 'show'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.show');

    Route::post('destroy', [DocumentoController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.destroy');

    // Gestionar archivo
    Route::post('store_archivo/{id}', [DocumentoController::class, 'storeArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.store_archivo');

    Route::post('update_archivo/{id}', [DocumentoController::class, 'updateArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('documento.update_archivo');

    Route::get('download/{id}', [DocumentoController::class, 'download'])
        ->middleware('roles:Gestor de Recursos,Gestor de Servicios,Diseñador Técnico')
        ->name('documento.download');

});

Route::prefix('pendon')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [PendonController::class, 'create'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.create');

    Route::post('store', [PendonController::class, 'store'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.store');

    Route::get('edit/{id}', [PendonController::class, 'edit'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.edit');

    Route::post('update/{id}', [PendonController::class, 'update'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.update');

    Route::get('/', [PendonController::class, 'index'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.index');

    Route::post('destroy', [PendonController::class, 'destroy'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.destroy');

    Route::get('show/{id}', [PendonController::class, 'show'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.show');

    // Gestionar archivo
    Route::get('download/{id}', [PendonController::class, 'download'])
        ->middleware('roles:Gestor de Recursos,Gestor de Servicios')
        ->name('pendon.download');

    Route::post('store_archivo/{id}', [PendonController::class, 'storeArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.store_archivo');

    Route::post('update_archivo/{id}', [PendonController::class, 'updateArchivo'])
        ->middleware('roles:Gestor de Recursos')
        ->name('pendon.update_archivo');

});

Route::prefix('servicio')
    ->middleware('auth')
    ->group(function () {

    Route::get('create', [ServicioController::class, 'create'])
        ->middleware('roles:Gestor de Ventas')
        ->name('servicio.create');

    Route::post('store', [ServicioController::class, 'store'])
        ->middleware('roles:Gestor de Ventas')
        ->name('servicio.store');

    Route::get('checklist/{id}', [ServicioController::class, 'checklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.checklist');

     //Guardar partes Checklist--------------   

    Route::post('guardar_logistica_coordinacion_checklist', [ServicioController::class, 'guardarDatosLogisticaCoordinacionChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_coordinacion_checklist');

    Route::post('guardar_logistica_material_relator_checklist', [ServicioController::class, 'guardarDatosLogisticaMaterialRelatorChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_material_relator_checklist');

    Route::post('guardar_logistica_material_participante_checklist', [ServicioController::class, 'guardarDatosLogisticaMaterialParticipanteChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_material_participante_checklist');

    Route::post('guardar_logistica_sence_checklist', [ServicioController::class, 'guardarDatosLogisticaSenceChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_sence_checklist');

    Route::post('guardar_logistica_outdoor_checklist', [ServicioController::class, 'guardarDatosLogisticaOutdoorChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_outdoor_checklist');

    Route::post('guardar_logistica_audio_iluminacion_checklist', [ServicioController::class, 'guardarDatosLogisticaAudioIluminacionChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_logistica_audio_iluminacion_checklist');

    Route::post('guardar_cierre_recepcion_checklist', [ServicioController::class, 'guardarDatosCierreRecepcionChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_cierre_recepcion_checklist');

    Route::post('guardar_cierre_checklist', [ServicioController::class, 'guardarDatosCierreChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_cierre_checklist');

    Route::post('guardar_observaciones_checklist', [ServicioController::class, 'guardarObservacionesChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.guardar_observaciones_checklist');

    Route::post('finalizar_logistica', [ServicioController::class, 'finalizarLogistica'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.finalizar_logistica');

    Route::post('finalizar_cierre', [ServicioController::class, 'finalizarCierre'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.finalizar_cierre');
    //Guardar y descargar archivos Checklist----------    
    Route::post('store_documento_checklist', [ServicioController::class, 'storeDocumentoChecklist'])
    ->middleware('roles:Gestor de Servicios')
    ->name('servicio.store_documento_checklist');

    Route::post('store_archivo_checklist/{id}', [ServicioController::class, 'storeArchivoChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.store_archivo_checklist');

    Route::get('download_archivo_checklist/{id}/{tipo}', [ServicioController::class, 'downloadArchivoChecklist'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.download_archivo_checklist');

    Route::get('descargar_archivo_otros/{hash_file_name}/{file_name}', [ServicioController::class, 'descargarArchivoOtros'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.descargar_archivo_otros');

    Route::post('eliminar_archivo_otros', [ServicioController::class, 'eliminarArchivoOtros'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.eliminar_archivo_otros'); 
    //-----------------------------------------------------------    
    Route::post('update/{id}', [ServicioController::class, 'update'])
    ->middleware('roles:Gestor de Servicios')
    ->name('servicio.update');

    Route::get('/', [ServicioController::class, 'index'])
        ->name('servicio.index');
        // ->middleware('roles:Gestor de Servicios,Diseñador Técnico,Administrador de Servicios');

    // Nota: La ruta de eliminación está comentada como en el original
    /*Route::post('destroy', [ServicioController::class, 'destroy'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.destroy');*/

    Route::post('cursos_propuesta', [ServicioController::class, 'getCursosPropuesta'])
        ->middleware('roles:Gestor de Ventas')
        ->name('servicio.cursos_propuesta');

    Route::post('actualizar_contactos', [ServicioController::class, 'actualizarContactos'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.actualizar_contactos');

    // Nota: Las siguientes dos rutas están etiquetadas para ser removidas según tu comentario, así que las dejaré como en el original
    Route::get('descargar_documento/{id}', [ServicioController::class, 'descargarDocumento'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.descargar_documento');

    Route::get('descargar_estructura/{id}', [ServicioController::class, 'descargarEstructura'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.descargar_estructura');
        // Diplomas----------------------------------------------------------------------------------------------------------
        Route::post('diploma_servicio_generar', [ServicioController::class, 'diplomaPorServicioGenerar'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.diploma_servicio');

    Route::get('abrir_diplomas', [ServicioController::class, 'abrirPdfDiplomas'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.abrir_diplomas');

    Route::get('diploma_servicio/{id}', [ServicioController::class, 'diplomaPorServicio'])
        ->middleware('roles:Gestor de Servicios')
        ->name('diplomas.diploma_servicio');

    Route::get('diploma_programa/{id}', [ServicioController::class, 'diplomaPorPrograma'])
        ->middleware('roles:Gestor de Servicios')
        ->name('diplomas.diploma_programa');

    Route::post('diploma_programa_generar', [ServicioController::class, 'diplomaPorProgramaGenerar'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.diploma_programa_generar');

    // Generar reporte básico--------------------------------------------------------------------------------------------
    Route::get('generar_reporte_basico/{id}', [ServicioController::class, 'generarReporteBasico'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.generar_reporte_basico');

    // Generar gafetes--------------------------------------------------------------------------------------------
    Route::get('generar_gafetes/{id}', [ServicioController::class, 'generarGafetes'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.generar_gafetes');

    // Exportar datos participantes programa-----------------------------------------------------------------------------
    Route::get('exportar_datos_participantes_programa/{id}', [ServicioController::class, 'exportarDatosParticipantesPrograma'])
        ->middleware('roles:Gestor de Servicios')
        ->name('servicio.exportar_datos_participantes_programa');

    //------------------------------------------------------------------------------------------------------------------
    
    Route::middleware(['roles:Gestor de Servicios'])->group(function () {
    Route::get('checklist_servicio/{id}', [ServicioController::class, 'checklistServicio'])->name('servicio.checklist_servicio');
    Route::post('guardar_datos_checklist', [ServicioController::class, 'guardarDatosChecklist'])->name('servicio.guardar_datos_checklist');
    Route::get('ingresar_participantes/{id}', [ServicioController::class, 'ingresarParticipantes'])->name('servicio.ingresar_participantes');
    Route::post('guardar_participantes', [ServicioController::class, 'guardarParticipantes'])->name('servicio.guardar_participantes');
    Route::post('eliminar_participante', [ServicioController::class, 'eliminarParticipante'])->name('servicio.eliminar_participante');
    Route::get('lista_asistencia_servicio/{id}', [ServicioController::class, 'listaAsistenciaServicio'])->name('servicio.lista_asistencia_servicio');
    Route::get('ingresar_encuestas_ads/{id}', [ServicioController::class, 'ingresarEncuestasADS'])->name('servicio.ingresar_encuestas_ads');
    Route::post('guardar_encuestas_ads', [ServicioController::class, 'guardarEncuestasADS'])->name('servicio.guardar_encuestas_ads');
});

    Route::middleware(['roles:Diseñador Técnico'])->group(function () {
        Route::get('disenio_tecnico/{id}', [ServicioController::class, 'disenioTecnico'])->name('servicio.disenio_tecnico');
        Route::post('guardar_disenio_tecnico', [ServicioController::class, 'guardarDisenioTecnico'])->name('servicio.guardar_disenio_tecnico');
        Route::post('finalizar_disenio_tecnico', [ServicioController::class, 'finalizarDisenioTecnico'])->name('servicio.finalizar_disenio_tecnico');
    });

    Route::middleware(['roles:Administrador de Servicios'])->group(function () {
        Route::get('administrar_servicio/{id}', [ServicioController::class, 'administrarServicio'])->name('servicio.administrar_servicio');
        Route::post('reniciar_etapas', [ServicioController::class, 'reiniciarEtapas'])->name('servicio.reniciar_etapas');
        Route::post('cancelar_servicio', [ServicioController::class, 'cancelarServicio'])->name('servicio.cancelar_servicio');
        Route::post('detener_servicio', [ServicioController::class, 'detenerServicio'])->name('servicio.detener_servicio');
        Route::post('reanudar_servicio', [ServicioController::class, 'reanudarServicio'])->name('servicio.reanudar_servicio');
    });
});


Route::prefix('estructura')->middleware('auth')->group(function () {

    Route::middleware(['roles:Diseñador Técnico'])->group(function () {
        Route::get('create_estructura/{id}', [CursoController::class, 'createEstructura'])->name('estructura.create');
        Route::post('store_estructura/{id}', [CursoController::class, 'storeEstructura'])->name('estructura.store');
        Route::get('edit_estructura/{id}', [CursoController::class, 'editEstructura'])->name('estructura.edit');
        Route::post('update_estructura/{id}', [CursoController::class, 'updateEstructura'])->name('estructura.update');
        Route::get('{id}', [CursoController::class, 'indexEstructura'])->name('estructura.index');
        Route::post('destroy_estructura', [CursoController::class, 'destroyEstructura'])->name('estructura.destroy');
        Route::post('store_archivo/{id}', [CursoController::class, 'storeArchivo'])->name('estructura.store_archivo');
        Route::post('update_archivo/{id}', [CursoController::class, 'updateArchivo'])->name('estructura.update_archivo');
    });

    Route::middleware(['roles:Diseñador Técnico,Gestor de Servicios'])->group(function () {
        Route::get('download/{id}', [CursoController::class, 'download'])->name('estructura.download');
    });

});

Route::prefix('orden_compra')->middleware('auth')->group(function () {

    Route::middleware(['roles:Gestor de Servicios'])->group(function () {
        Route::get('create/{id}', [OrdenCompraController::class, 'create'])->name('orden_compra.create');
        Route::post('store', [OrdenCompraController::class, 'store'])->name('orden_compra.store');
        Route::get('edit/{id}', [OrdenCompraController::class, 'edit'])->name('orden_compra.edit');
        Route::post('update/{id}', [OrdenCompraController::class, 'update'])->name('orden_compra.update');
        Route::get('{id}', [OrdenCompraController::class, 'index'])->name('orden_compra.index');
        Route::get('show/{id}', [OrdenCompraController::class, 'show'])->name('orden_compra.show');
        Route::post('destroy', [OrdenCompraController::class, 'destroy'])->name('orden_compra.destroy');
    });

});

use App\Http\Controllers\ParametroController;

Route::prefix('parametro')->middleware('auth')->group(function () {
    Route::middleware('roles:Administrador de Servicios')->group(function () {
        Route::get('/edit_parametros', [ParametroController::class, 'editParametros'])->name('parametro.edit_parametros');
        Route::post('/update_parametros', [ParametroController::class, 'updateParametros'])->name('parametro.update_parametros');
    });
});
