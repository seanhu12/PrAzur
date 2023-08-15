<?php

namespace App\Http\Controllers;

use App\Models\CheckCierre;
use App\Models\CheckCoordinacion;
use App\Models\CheckSence;
use App\Models\DisenoTecnico;
use App\Models\CheckMaterialParticipante;
use App\Models\CheckMaterialRelator;
use App\Models\DocumentoChecklist;
use App\Models\EtapaServicio;
use App\Http\Controllers\Servicios\Comun;
use App\Http\Controllers\Servicios\ExportarDatosParticipantesPrograma;
use App\Http\Controllers\Servicios\GenerarChecklist;
use App\Http\Controllers\Servicios\GenerarDiplomas;
use App\Http\Controllers\Servicios\GenerarGafetes;
use App\Http\Controllers\Servicios\GenerarListaAsistencia;
use App\Http\Controllers\Servicios\GenerarResumenServicio;
use App\Http\Controllers\Servicios\ServiciosServicio;
use App\Models\Notificacion;
use App\Models\Parametro;
use App\Models\Participante;
use App\Models\Servicio;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Etapa;
use App\Models\EstadoOperacional;
use App\Models\Propuesta;
use App\Models\Ciudad;
use App\Models\Relator;
use App\Models\ContactoEmpresa;
use App\Models\ContactoEmpresaPropuesta;
use App\Models\ContactoOtic;
use App\Models\Documento;
use App\Models\Estructura;
use App\Models\Pendon;
use App\Models\Proyector;
use App\Models\Notebook;
use App\Models\DocumentoServicio;
use App\Models\CheckOutdoor;
use App\Models\CheckAudioIluminacion;
use App\Models\ParticipanteServicio;
use App\Models\Evaluacion;
use App\Models\User;
use App\Models\EncuestaAds;
use App\Models\ParticipantePerfil;
use Illuminate\Http\Request;
use Mpdf\Tag\S;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicio = new Servicio();
        $servicios = $servicio->get_servicios();

        //PARA PROBAR SCHEDULE
        //$serv= new ServiciosServicio();
        //$serv->actualizacionEtapas($servicios);

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Obtener empresas
        $empresa = new Empresa();
        $empresas = $empresa->get_all_empresas();
        $empresasJson = json_encode($empresas);

        // Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_all_cursos();
        $cursosJson = json_encode($cursos);

        // Obtener etapas
        $etapa = new Etapa();
        $etapas = $etapa->get_etapas();
        $etapasJson = json_encode($etapas);

        // Obtener estados
        $estado = new EstadoOperacional();
        $estados = $estado->get_estado_operacional();
        $estadosJson = json_encode($estados);

        return view('servicio.index')
            ->with(compact('fechaActual'))
            ->with(compact('empresasJson'))
            ->with(compact('cursosJson'))
            ->with(compact('etapasJson'))
            ->with(compact('estadosJson'))
            ->with(compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Obtener propuetsa
        $propuetsa = new Propuesta();
        $propuestas = $propuetsa->get_propuestas_confirmadas();
        $propuestasJson = json_encode($propuestas);

        // Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_all_cursos();
        $cursosJson = json_encode($cursos);

        //Obtener las ciudades
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        //Obtener los relatores
        $relator = new Relator;
        $relatores = $relator->get_relatores();
        $relatoresJson = json_encode($relatores);

        return view('servicio.create')
            ->with(compact('propuestasJson'))
            ->with(compact('cursosJson'))
            ->with(compact('ciudadesJson'))
            ->with(compact('relatoresJson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = $request->input('servicio');

        $usuario= new User();
        $usuarios= $usuario->get_users();
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('propuestaId'));

        $montoFinal = $propuesta->monto_final + $servicio['monto'];

        $propuesta->update([
            'monto_final' => $montoFinal
        ]);

        // Verificar si aplica manuales
        $aplicaManual = 0;
        if ($servicio['actividades']['carpetaParticipantes'] == 1 || $servicio['actividades']['velobind'] == 1) {
            $aplicaManual = 1;
        }
        // Check diseño técnico
        $disenoTecnico = new DisenoTecnico([
            'manual_aplica' => $aplicaManual,
            'prueba_aplica' => $servicio['actividades']['pruebas'],
            'guia_aplica' => $servicio['actividades']['guias'],
            'encuesta_empresa_aplica' => $servicio['actividades']['encuestaEmpresa'],
            'encuesta_adicionales_aplica' => $servicio['actividades']['encuestaAdicionales'],
        ]);
        $disenoTecnico->save();

        // Check Coordinación
        $checkCoordinacion = new CheckCoordinacion([
            'coffee_aplica' => $servicio['actividades']['coffee'],
            'almuerzo_aplica' => $servicio['actividades']['almuerzo'],
        ]);
        $checkCoordinacion->save();

        // Check material relator
        // $checkMaterialRelator = new CheckMaterialRelator([

        // ]);
        // $checkMaterialRelator->save();

        // Check material participantes
        $checkMaterialparticipantes = new CheckMaterialParticipante([
            'bitacora_aplica' => $servicio['actividades']['bitacora'],
            'carpeta_ads_aplica' => $servicio['actividades']['carpetaParticipantes'],
            'velobind_aplica' => $servicio['actividades']['velobind'],
            'lapices_aplica' => $servicio['actividades']['lapices'],
        ]);
        $checkMaterialparticipantes->save();

        // Check cierre
        $checkCierre = new CheckCierre([
            'diplomas_aplica' => $servicio['actividades']['diplomaCurso'],
        ]);
        $checkCierre->save();

        $checkOutdoorId = null;
        if ($servicio['actividades']['outdoor'] == 1) {
            // Check outdoor
            $checkOutdoor = new CheckOutdoor([
                'venda_aplica' => $servicio['outdoor']['venda'],
                'pvc_aplica' => $servicio['outdoor']['pvc'],
                'pelota_aplica' => $servicio['outdoor']['pelota'],
                'plumones_aplica' => $servicio['outdoor']['plumones'],
                'papel_craf_aplica' => $servicio['outdoor']['papelKraft'],
                'pechera_aplica' => $servicio['outdoor']['pechera'],
                'masquin_aplica' => $servicio['outdoor']['masking'],
                'bolsa_basura_aplica' => $servicio['outdoor']['bolsaBasura'],
                'cono_aplica' => $servicio['outdoor']['cono'],
                'plato_aplica' => $servicio['outdoor']['plato'],
                'aro_madera_aplica' => $servicio['outdoor']['aroMadera'],
                'tijera_aplica' => $servicio['outdoor']['tijera'],
                'esqui_aplica' => $servicio['outdoor']['esqui'],
                'otros' => $servicio['outdoor']['otros']
            ]);
            $checkOutdoor->save();
            $checkOutdoorId = $checkOutdoor->id;
        }

        $checkAudioIluminacionId = null;
        if ($servicio['actividades']['audioIluminacion'] == 1) {
            // Check audio e iluminacion
            $checkAudioIluminacion = new CheckAudioIluminacion([
                'parlantes_aplica' => $servicio['audioIluminacion']['parlantes'],
                'atril_aplica' => $servicio['audioIluminacion']['atril'],
                'alargador_aplica' => $servicio['audioIluminacion']['alargador'],
                'foco_aplica' => $servicio['audioIluminacion']['foco'],
                'microfono_cintillo_aplica' => $servicio['audioIluminacion']['microfonoCintillo'],
                'microfono_inalambrico_aplica' => $servicio['audioIluminacion']['microfonoInalambrico'],
                'otros' => $servicio['audioIluminacion']['otros']
            ]);
            $checkAudioIluminacion->save();
            $checkAudioIluminacionId = $checkAudioIluminacion->id;
        }

        // crear servicio
        $newServicio = new Servicio([
            'nombre' => $servicio['nombre'],
            'ot' => '--',
            'fecha_ejecucion' => $servicio['fechaEjecucion'],
            'horario' => $servicio['horario'],
            'lugar_realizacion' => $servicio['lugar'],
            'salon' => $servicio['salon'],
            'cant_horas' => $servicio['numeroHoras'],
            'cant_participantes' => $servicio['numeroParticipantes'],
            'detalles' => $servicio['detalles'],
            // 'id_accion' => $servicio[''],
            // 'horario_coffe_am' => $servicio[''],
            // 'horario_coffe_pm' => $servicio[''],
            // 'horario_almuerzo' => $servicio[''],
            'sence_aplica' => $servicio['sence'],
            'monto_servicio' => $servicio['monto'],
            // 'observaciones_checklist' => $servicio[''],
            'outdoor_aplica' => $servicio['actividades']['outdoor'],
            'audio_iluminacion_aplica' => $servicio['actividades']['audioIluminacion'],
            'diploma_programa_aplica' => $request->input('diplomaPrograma'),
            // 'certificado_sence' => $servicio[''],
            'curso_id' => $servicio['cursoId'],
            'ciudad_id' => $servicio['ciudadId'],
            'propuesta_id' => $request->input('propuestaId'),
            'relator_id' => $servicio['relatorId'],
            // 'notebook_id' => $servicio[''],
            // 'proyector_id' => $servicio[''],
            'diseno_tecnico_id' => $disenoTecnico->id,
            'check_coordinacion_id' =>$checkCoordinacion->id,
            'check_material_participante_id' =>$checkMaterialparticipantes->id,
            // 'check_material_relator_id' =>$checkMaterialRelator->id,
            // 'check_sence_id' => ,
            'check_cierre_id' =>$checkCierre->id,
            'check_outdoor_id' =>$checkOutdoorId,
            'check_audio_iluminacion_id' =>$checkAudioIluminacionId
        ]);
        $newServicio->save();

        $newServicio->update([
            'ot' => 'OT'.$newServicio->id
        ]);

        //asignar etapa
        $newServicio->set_etapa(1);

        //asignar estado operacional
        $newServicio->set_estado_operacional(1);

        //se actulizar monto acumulado en la tabla meta venta.
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('propuestaId'));
        $newServicio->update_monto_acumulado($propuesta->empresa_id);
        
        //NOTIFICAR A TODOS LOS USUARIOS DEL SERVICIO CREADO
        foreach ($usuarios as $usuario){
            if($usuario->has_rol('Gestor de Servicios')){
                $notificacion= new Notificacion([
                    'mensaje' => 'Se ha creado el Servicio '.$newServicio->ot,
                    'direccion' => '/servicio/checklist/'.$newServicio->id,
                    'tipo' => 'Aviso',
                    'leido_si_no' => false,
                    'user_id' => $usuario->id,
                ]);
                $notificacion->save();
            }else{
                if($usuario->has_rol('Diseñador Técnico')){
                    $notificacion= new Notificacion([
                        'mensaje' => 'Se ha creado el Servicio '.$newServicio->ot.'. Ir a Diseño Técnico.',
                        'direccion' => '/servicio/disenio_tecnico/'.$newServicio->id,
                        'tipo' => 'Aviso',
                        'leido_si_no' => false,
                        'user_id' => $usuario->id,
                    ]);
                    $notificacion->save();
                }else{
                    $notificacion= new Notificacion([
                        'mensaje' => 'Se ha creado el Servicio '.$newServicio->ot,
                        'direccion' => '/home',
                        'tipo' => 'Aviso',
                        'leido_si_no' => false,
                        'user_id' => $usuario->id,
                    ]);
                    $notificacion->save();
                }
            }
            if($usuario->has_rol('Diseñador Técnico')){
                $notificacion= new Notificacion([
                    'mensaje' => 'Se ha creado el Servicio '.$newServicio->ot.'. Ir a Diseño Técnico.',
                    'direccion' => '/servicio/disenio_tecnico/'.$newServicio->id,
                    'tipo' => 'Aviso',
                    'leido_si_no' => false,
                    'user_id' => $usuario->id,
                ]);
                $notificacion->save();
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function checklist($id)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($id);

        //Obtener las ciudades
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        //Obtener los relatores
        $relator = new Relator;
        $relatores = $relator->get_relatores();
        $relatoresJson = json_encode($relatores);

        $contactosEmpresaJson = json_encode($servicio->propuesta()->empresa()->contactos_empresa());

        // Obtener contactos otic
        $contactoOtic = new ContactoOtic();
        $contactosOtic = $contactoOtic->get_contactos();
        $contactosOticJson = json_encode($contactosOtic);

        // Obtener pendones
        $pendon = new Pendon();
        $pendones = $pendon->get_pendones();
        $pendones = json_encode($pendones);

        // Obtener proyectores
        $proyector = new Proyector();
        $proyectores = $proyector->get_proyectors();
        $proyectores = json_encode($proyectores);

        // Obtener notebooks
        $notebook = new Notebook();
        $notebooks = $notebook->get_notebooks();
        $notebooks = json_encode($notebooks);

        // Obtener contactos otic
        $documento = new Documento();

        $hayParticipantes = count($servicio->participantes());

        return view('servicio.checklist')
            ->with(compact('hayParticipantes'))
            ->with(compact('pendones'))
            ->with(compact('proyectores'))
            ->with(compact('notebooks'))
            ->with(compact('documento'))
            ->with(compact('relatoresJson'))
            ->with(compact('ciudadesJson'))
            ->with(compact('contactosEmpresaJson'))
            ->with(compact('contactosOticJson'))
            ->with(compact('servicio'));
    }

    /**
     * Guardar los datos del checklist (Solo la informacion del servicio).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $servicio->update([
            'fecha_ejecucion' => $request->input('fecha_ejecucion'),
            'horario' => $request->input('horario'),
            'id_accion' => $request->input('id_accion'),
            'lugar_realizacion' => $request->input('lugar_realizacion'),
            'ciudad_id' => $request->input('ciudad_id')
        ]);
    }

    /**
     * Guardar los datos de coordinación del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatoslogisticaCoordinacionChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));
        $servicio->update([
            'salon' => $request->input('salon'),
            'horario_coffee_am' => $request->input('horario_coffee_am'),
            'horario_coffee_pm' => $request->input('horario_coffee_pm'),
            'horario_almuerzo' => $request->input('horario_almuerzo'),
        ]);

        $checkCoordinacion=$servicio->check_coordinacion();

        $checkCoordinacion->update([
            'coffee_aplica' => $request->input('coffee_aplica'),
            'almuerzo_aplica' => $request->input('almuerzo_aplica'),
            'coordinar_sala_listo' => $request->input('coordinar_sala_listo'),
            'coffee_listo' => $request->input('coffee_listo'),
            'almuerzo_listo' => $request->input('almuerzo_listo'),
            'nomina_participantes_listo' => $request->input('nomina_participantes_listo')
        ]);
    }

    /**
     * Guardar los datos del material del relator, de la sección logística del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosLogisticaMaterialRelatorChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $checkMaterialRelator=$servicio->check_material_relator();
        if($checkMaterialRelator==null){
            $checkMaterialRelator= new CheckMaterialRelator([
                'libro_asistencia_listo' => $request->input('libro_asistencia_listo'),
                'encuesta_ads_listo' => $request->input('encuesta_ads_listo'),
                'encuesta_empresa_aplica' => $request->input('encuesta_empresa_aplica'),
                'encuesta_empresa_listo' => $request->input('encuesta_empresa_listo'),
                'pendones_listo' => $request->input('pendones_listo'),
                'proyector_aplica' => $request->input('proyector_aplica'),
                'proyector_listo' => $request->input('proyector_listo'),
                'preparar_guia_aplica' => $request->input('preparar_guia_aplica'),
                'preparar_guia_listo' => $request->input('preparar_guia_listo'),
                'preparar_prueba_aplica' => $request->input('preparar_prueba_aplica'),
                'preparar_prueba_listo' => $request->input('preparar_prueba_listo'),
                'plumones_aplica' => $request->input('plumones_aplica'),
                'plumones_listo' => $request->input('plumones_listo'),
                'notebook_aplica' => $request->input('notebook_aplica'),
                'notebook_listo' => $request->input('notebook_listo'),
                'encuesta_adicional_aplica' => $request->input('encuesta_adicional_aplica'),
                'encuesta_adicional_listo' => $request->input('encuesta_adicional_listo'),
            ]);
            $checkMaterialRelator->save();
            $servicio->update([
                'check_material_relator_id' => $checkMaterialRelator->id,
            ]);
            //Guardar pendones
            if($request->input('hayPendones')=='true'){
                $servicio->set_pendones(implode(',',$request->input('pendones_ids')));
            }else{
                $servicio->del_pendones();
            }
            //Guardar Notebook
            if($request->input('hayNotebook')=='true'){
                $servicio->update([
                    'notebook_id' => $request->input('notebook_id')
                ]);
            }else{
                $servicio->update([
                    'notebook_id' => null
                ]);
            }
            //Guardar Proyector
            if($request->input('hayProyector')=='true'){
                $servicio->update([
                    'proyector_id' => $request->input('proyector_id')
                ]);
            }else{
                $servicio->update([
                    'proyector_id' => null
                ]);
            }
        }else{
            $checkMaterialRelator->update([
                'libro_asistencia_listo' => $request->input('libro_asistencia_listo'),
                'encuesta_ads_listo' => $request->input('encuesta_ads_listo'),
                'encuesta_empresa_aplica' => $request->input('encuesta_empresa_aplica'),
                'encuesta_empresa_listo' => $request->input('encuesta_empresa_listo'),
                'pendones_listo' => $request->input('pendones_listo'),
                'proyector_aplica' => $request->input('proyector_aplica'),
                'proyector_listo' => $request->input('proyector_listo'),
                'preparar_guia_aplica' => $request->input('preparar_guia_aplica'),
                'preparar_guia_listo' => $request->input('preparar_guia_listo'),
                'preparar_prueba_aplica' => $request->input('preparar_prueba_aplica'),
                'preparar_prueba_listo' => $request->input('preparar_prueba_listo'),
                'plumones_aplica' => $request->input('plumones_aplica'),
                'plumones_listo' => $request->input('plumones_listo'),
                'notebook_aplica' => $request->input('notebook_aplica'),
                'notebook_listo' => $request->input('notebook_listo'),
                'encuesta_adicional_aplica' => $request->input('encuesta_adicional_aplica'),
                'encuesta_adicional_listo' => $request->input('encuesta_adicional_listo'),
            ]);
            //Guardar pendones
            if($request->input('hayPendones')=='true'){
                $servicio->set_pendones(implode(',',$request->input('pendones_ids')));
            }else{
                $servicio->del_pendones();
            }
            //Guardar Notebook
            if($request->input('hayNotebook')=='true'){
                $servicio->update([
                    'notebook_id' => $request->input('notebook_id')
                ]);
            }else{
                $servicio->update([
                    'notebook_id' => null
                ]);
            }
            //Guardar Proyector
            if($request->input('hayProyector')=='true'){
                $servicio->update([
                    'proyector_id' => $request->input('proyector_id')
                ]);
            }else{
                $servicio->update([
                    'proyector_id' => null
                ]);
            }
        }
    }

    /**
     * Guardar los datos del material del participante, de la sección logística del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosLogisticaMaterialParticipanteChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $checkMaterialParticipante=$servicio->check_material_participante();

        $checkMaterialParticipante->update([
            'gafete_aplica' => $request->input('gafete_aplica'),
            'gafete_listo' => $request->input('gafete_listo'),
            'bitacora_aplica' => $request->input('bitacora_aplica'),
            'bitacora_listo' => $request->input('bitacora_listo'),
            'carpeta_ads_aplica' => $request->input('carpeta_ads_aplica'),
            'carpeta_ads_listo' => $request->input('carpeta_ads_listo'),
            'lapices_aplica' => $request->input('lapices_aplica'),
            'lapices_listo' => $request->input('lapices_listo'),
            'velobind_aplica' => $request->input('velobind_aplica'),
            'velobind_listo' => $request->input('velobind_listo'),
        ]);
    }

    /**
     * Guardar los datos del sence, de la sección logística del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosLogisticaSenceChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $checkSence=$servicio->check_sence();
        if($checkSence==null){
            $checkSence= new CheckSence([
                'sence_id_cargado_aplica' => $request->input('sence_id_cargado_aplica'),
                'sence_id_cargado_listo' => $request->input('sence_id_cargado_listo'),
                'verificar_lector_bio_aplica' => $request->input('verificar_lector_bio_aplica'),
                'verificar_lector_bio_listo' => $request->input('verificar_lector_bio_listo'),
                'reglamento_sence_aplica' => $request->input('reglamento_sence_aplica'),
                'reglamento_sence_listo' => $request->input('reglamento_sence_listo'),
            ]);
            $checkSence->save();
            $servicio->update([
                'check_sence_id' => $checkSence->id,
            ]);
        }else{
            $checkSence->update([
                'sence_id_cargado_aplica' => $request->input('sence_id_cargado_aplica'),
                'sence_id_cargado_listo' => $request->input('sence_id_cargado_listo'),
                'verificar_lector_bio_aplica' => $request->input('verificar_lector_bio_aplica'),
                'verificar_lector_bio_listo' => $request->input('verificar_lector_bio_listo'),
                'reglamento_sence_aplica' => $request->input('reglamento_sence_aplica'),
                'reglamento_sence_listo' => $request->input('reglamento_sence_listo'),
            ]);
        }

        $servicio->update([
            'sence_aplica' => $request->input('sence_aplica')
        ]);
    }

    /**
     * Guardar los datos del material del relator, de la sección logística del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosLogisticaOutdoorChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $checkOutdoor=$servicio->check_outdoor();
        if($checkOutdoor==null){
            $checkOutdoor= new CheckOutdoor([
                'venda_aplica' => $request->input('venda_aplica'),
                'venda_listo' => $request->input('venda_listo'),
                'pvc_aplica' => $request->input('pvc_aplica'),
                'pvc_listo' => $request->input('pvc_listo'),
                'pelota_aplica' => $request->input('pelota_aplica'),
                'pelota_listo' => $request->input('pelota_listo'),
                'plumones_aplica' => $request->input('plumones_aplica'),
                'plumones_listo' => $request->input('plumones_listo'),
                'papel_craf_aplica' => $request->input('papel_craf_aplica'),
                'papel_craf_listo' => $request->input('papel_craf_listo'),
                'pechera_aplica' => $request->input('pechera_aplica'),
                'pechera_listo' => $request->input('pechera_listo'),
                'masquin_aplica' => $request->input('masquin_aplica'),
                'masquin_listo' => $request->input('masquin_listo'),
                'bolsa_basura_aplica' => $request->input('bolsa_basura_aplica'),
                'bolsa_basura_listo' => $request->input('bolsa_basura_listo'),
                'cono_aplica' => $request->input('cono_aplica'),
                'cono_listo' => $request->input('cono_listo'),
                'plato_aplica' => $request->input('plato_aplica'),
                'plato_listo' => $request->input('plato_listo'),
                'aro_madera_aplica' => $request->input('aro_madera_aplica'),
                'aro_madera_listo' => $request->input('aro_madera_listo'),
                'tijera_aplica' => $request->input('tijera_aplica'),
                'tijera_listo' => $request->input('tijera_listo'),
                'esqui_aplica' => $request->input('esqui_aplica'),
                'esqui_listo' => $request->input('esqui_listo'),
                'otros' => $request->input('otros'),
            ]);
            $checkOutdoor->save();
            $servicio->update([
                'check_outdoor_id' => $checkOutdoor->id,
            ]);
        }else{
            $checkOutdoor->update([
                'venda_aplica' => $request->input('venda_aplica'),
                'venda_listo' => $request->input('venda_listo'),
                'pvc_aplica' => $request->input('pvc_aplica'),
                'pvc_listo' => $request->input('pvc_listo'),
                'pelota_aplica' => $request->input('pelota_aplica'),
                'pelota_listo' => $request->input('pelota_listo'),
                'plumones_aplica' => $request->input('plumones_aplica'),
                'plumones_listo' => $request->input('plumones_listo'),
                'papel_craf_aplica' => $request->input('papel_craf_aplica'),
                'papel_craf_listo' => $request->input('papel_craf_listo'),
                'pechera_aplica' => $request->input('pechera_aplica'),
                'pechera_listo' => $request->input('pechera_listo'),
                'masquin_aplica' => $request->input('masquin_aplica'),
                'masquin_listo' => $request->input('masquin_listo'),
                'bolsa_basura_aplica' => $request->input('bolsa_basura_aplica'),
                'bolsa_basura_listo' => $request->input('bolsa_basura_listo'),
                'cono_aplica' => $request->input('cono_aplica'),
                'cono_listo' => $request->input('cono_listo'),
                'plato_aplica' => $request->input('plato_aplica'),
                'plato_listo' => $request->input('plato_listo'),
                'aro_madera_aplica' => $request->input('aro_madera_aplica'),
                'aro_madera_listo' => $request->input('aro_madera_listo'),
                'tijera_aplica' => $request->input('tijera_aplica'),
                'tijera_listo' => $request->input('tijera_listo'),
                'esqui_aplica' => $request->input('esqui_aplica'),
                'esqui_listo' => $request->input('esqui_listo'),
                'otros' => $request->input('otros'),
            ]);
        }
    }

    /**
     * Guardar los datos del material del relator, de la sección logística del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosLogisticaAudioIluminacionChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $checkAudio=$servicio->check_audio_iluminacion();
        if($checkAudio==null){
            $checkAudio= new CheckAudioIluminacion([
                'parlantes_aplica' => $request->input('parlantes_aplica'),
                'parlantes_listo' => $request->input('parlantes_listo'),
                'atril_aplica' => $request->input('atril_aplica'),
                'atril_listo' => $request->input('atril_listo'),
                'alargador_aplica' => $request->input('alargador_aplica'),
                'alargador_listo' => $request->input('alargador_listo'),
                'foco_aplica' => $request->input('foco_aplica'),
                'foco_listo' => $request->input('foco_listo'),
                'microfono_cintillo_aplica' => $request->input('microfono_cintillo_aplica'),
                'microfono_cintillo_listo' => $request->input('microfono_cintillo_listo'),
                'microfono_inalambrico_aplica' => $request->input('microfono_inalambrico_aplica'),
                'microfono_inalambrico_listo' => $request->input('microfono_inalambrico_listo'),
                'otros' => $request->input('otros'),
            ]);
            $checkAudio->save();
            $servicio->update([
                'check_audio_iluminacion_id' => $checkAudio->id,
            ]);
        }else{
            $checkAudio->update([
                'parlantes_aplica' => $request->input('parlantes_aplica'),
                'parlantes_listo' => $request->input('parlantes_listo'),
                'parlantes_recepcion' => $request->input('parlantes_recepcion'),
                'atril_aplica' => $request->input('atril_aplica'),
                'atril_listo' => $request->input('atril_listo'),
                'atril_recepcion' => $request->input('atril_recepcion'),
                'alargador_aplica' => $request->input('alargador_aplica'),
                'alargador_listo' => $request->input('alargador_listo'),
                'alargador_recepcion' => $request->input('alargador_recepcion'),
                'foco_aplica' => $request->input('foco_aplica'),
                'foco_listo' => $request->input('foco_listo'),
                'foco_recepcion' => $request->input('foco_recepcion'),
                'microfono_cintillo_aplica' => $request->input('microfono_cintillo_aplica'),
                'microfono_cintillo_listo' => $request->input('microfono_cintillo_listo'),
                'microfono_cintillo_recepcion' => $request->input('microfono_cintillo_recepcion'),
                'microfono_inalambrico_aplica' => $request->input('microfono_inalambrico_aplica'),
                'microfono_inalambrico_listo' => $request->input('microfono_inalambrico_listo'),
                'microfono_inalambrico_recepcion' => $request->input('microfono_inalambrico_recepcion'),
                'otros' => $request->input('otros'),
            ]);
        }
    }

    /**
     * Guardar los datos de recepción del material del relator, sence, outdoor y audio e iluminación, de la sección cierre del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosCierreRecepcionChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        //Obtener Checks
        $checkMaterialRelator=$servicio->check_material_relator();
        $checkSence=$servicio->check_sence();
        $checkOutdoor=$servicio->check_outdoor();
        $checkAudio=$servicio->check_audio_iluminacion();


        //Actualizar Checks
        if($checkMaterialRelator!=null){
            $checkMaterialRelator->update([
                'libro_asistencia_recepcion' => $request->input('libro_asistencia_recepcion'),
                'encuesta_ads_recepcion' => $request->input('encuesta_ads_recepcion'),
                'encuesta_empresa_recepcion' => $request->input('encuesta_empresa_recepcion'),
                'pendones_recepcion' => $request->input('pendones_recepcion'),
                'proyector_recepcion' => $request->input('proyector_recepcion'),
                'preparar_guia_recepcion' => $request->input('preparar_guia_recepcion'),
                'preparar_prueba_recepcion' => $request->input('preparar_prueba_recepcion'),
                'plumones_recepcion' => $request->input('plumones_recepcion'),
                'notebook_recepcion' => $request->input('notebook_recepcion'),
                'encuesta_adicional_recepcion' => $request->input('encuesta_adicional_recepcion'),
            ]);
        }
        if($checkSence!=null){
            $checkSence->update([
                'verificar_lector_bio_recepcion' => $request->input('verificar_lector_bio_recepcion'),
            ]);
        }
        if($checkOutdoor!=null){
            $checkOutdoor->update([
                'venda_recepcion' => $request->input('venda_recepcion'),
                'pvc_recepcion' => $request->input('pvc_recepcion'),
                'pelota_recepcion' => $request->input('pelota_recepcion'),
                'plumones_recepcion' => $request->input('plumones_recepcion_outdoor'),
                'papel_craf_recepcion' => $request->input('papel_craf_recepcion'),
                'pechera_recepcion' => $request->input('pechera_recepcion'),
                'masquin_recepcion' => $request->input('masquin_recepcion'),
                'bolsa_basura_recepcion' => $request->input('bolsa_basura_recepcion'),
                'cono_recepcion' => $request->input('cono_recepcion'),
                'plato_recepcion' => $request->input('plato_recepcion'),
                'aro_madera_recepcion' => $request->input('aro_madera_recepcion'),
                'tijera_recepcion' => $request->input('tijera_recepcion'),
                'esqui_recepcion' => $request->input('esqui_recepcion'),
            ]);
        }
        if($checkAudio!=null){
            $checkAudio->update([
                'parlantes_recepcion' => $request->input('parlantes_recepcion'),
                'atril_recepcion' => $request->input('atril_recepcion'),
                'alargador_recepcion' => $request->input('alargador_recepcion'),
                'foco_recepcion' => $request->input('foco_recepcion'),
                'microfono_cintillo_recepcion' => $request->input('microfono_cintillo_recepcion'),
                'microfono_inalambrico_recepcion' => $request->input('microfono_inalambrico_recepcion'),
            ]);
        }
    }

    /**
     * Guardar los datos de la sección cierre del Checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDatosCierreChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        //Obtener Checks
        $checkCierre=$servicio->check_cierre();

        //Actualizar Checks
        if($checkCierre==null){
            $checkCierre= new CheckCierre([
                'diplomas_aplica' => $request->input('diplomas_aplica'),
                'diplomas_listo' => $request->input('diplomas_listo'),
                'nota_listo' => $request->input('nota_listo'),
                'orden_compra_listo' => $request->input('orden_compra_listo'),
                'certificado_sence_aplica' => $request->input('certificado_sence_aplica'),
                'certificado_sence_listo' => $request->input('certificado_sence_listo'),
                'libro_asistencia_listo' => $request->input('libro_asistencia_listo'),
                'resultado_encuestas_ads_listo' => $request->input('resultado_encuestas_ads_listo'),
            ]);
            $checkCierre->save();
            $servicio->update([
                'check_cierre_id' => $checkCierre->id,
                'certificado_sence' => $request->input('certificado_sence'),
            ]);
        }else{
            $checkCierre->update([
                'diplomas_aplica' => $request->input('diplomas_aplica'),
                'diplomas_listo' => $request->input('diplomas_listo'),
                'nota_listo' => $request->input('nota_listo'),
                'orden_compra_listo' => $request->input('orden_compra_listo'),
                'certificado_sence_aplica' => $request->input('certificado_sence_aplica'),
                'certificado_sence_listo' => $request->input('certificado_sence_listo'),
                'libro_asistencia_listo' => $request->input('libro_asistencia_listo'),
                'resultado_encuestas_ads_listo' => $request->input('resultado_encuestas_ads_listo'),
            ]);
            $servicio->update([
                'certificado_sence' => $request->input('certificado_sence'),
            ]);
        }

    }

    /**
     * Guardar las observaciones del checklist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarObservacionesChecklist(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $servicio->update([
            'observaciones_checklist' => $request->input('observaciones_checklist')
        ]);
    }


    /**
     * Finalizar la etapa de logistica.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function finalizarLogistica(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $servicio->update([
            'logistica_listo' => 1
        ]);

        if ($servicio->get_last_etapa()->id == '2') {
            $servicio->set_etapa(3);

            $etapaServicio = new EtapaServicio();
            $etapaServicio = $etapaServicio->get_etapa_servicio(3,$servicio->id);
            $etapaServicio->set_end_update();
        }
    }


    /**
     * Finalizar la etapa de cierre.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function finalizarCierre(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));
        //Obtener usuarios
        $usuario= new User();
        $usuarios= $usuario->get_users();

        $servicio->update([
            'cierre_listo' => 1
        ]);

        if ($servicio->get_last_etapa()->id == '5') {
            $servicio->set_etapa(6);
            $servicio->set_estado_operacional(4);
        }
        //Obtener propuesta
        $propuesta = new Propuesta();
        $propuesta=$propuesta->get_propuesta($servicio->propuesta_id);
        //NOTIFICAR A TODOS LOS USUARIOS DEL SERVICIO CERRADO
        foreach ($usuarios as $usuario){
            if($usuario->has_rol('Gestor de Servicios')){
                $notificacion= new Notificacion([
                    'mensaje' => 'Se ha cerrado el Servicio '.$servicio->ot,
                    'direccion' => '/servicio/checklist/'.$servicio->id,
                    'tipo' => 'Aviso',
                    'leido_si_no' => false,
                    'user_id' => $usuario->id,
                ]);
            }else{
                if($usuario->has_rol('Diseñador Técnico')){
                    $notificacion= new Notificacion([
                        'mensaje' => 'Se ha cerrado el Servicio '.$servicio->ot,
                        'direccion' => '/servicio/disenio_tecnico/'.$servicio->id,
                        'tipo' => 'Aviso',
                        'leido_si_no' => false,
                        'user_id' => $usuario->id,
                    ]);
                }else{
                    $notificacion= new Notificacion([
                        'mensaje' => 'Se ha cerrado el Servicio '.$servicio->ot,
                        'direccion' => '/home',
                        'tipo' => 'Aviso',
                        'leido_si_no' => false,
                        'user_id' => $usuario->id,
                    ]);
                }
            }
            $notificacion->save();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Enviar los cursos de una propuesta
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCursosPropuesta(Request $request)
    {
        // Obtener cursos del porgrama
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('propuestaId'));
        if ($propuesta->tipo_servicio_id == 1) {
            $cursosPropuesta = $propuesta->programa()->cursos();
        } else {
            $cursosPropuesta = array();
            array_push($cursosPropuesta, $propuesta->curso());
        }
        $cursosPropuestaJson = json_encode($cursosPropuesta);

        return $cursosPropuestaJson;
    }

    /**
     * Actualiza los contactos de la empresa
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarContactos(Request $request)
    {
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('propuestaId'));

        // Actualizar contacto otic
        if ($request->input('contactoOticId') != null) {
            $propuesta->update([
                'contacto_otic_id' => $request->input('contactoOticId'),
            ]);
            $propuesta->save();
        } else {
            $propuesta->update([
                'contacto_otic_id' => null,
            ]);
            $propuesta->save();
        }

        //Almacenar contacto venta empresa
        if ($request->input('contactoVentaId') != null) {
            if ($propuesta->get_contacto_empresa_propuesta(1) == null) {
                //Almacenar nuevo contacto empresa
                $contactoEmpresaPropuesta = new ContactoEmpresaPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'contacto_empresa_id' => $request->input('contactoVentaId'),
                    'tipo_contacto_id' => 1 //contacto Venta
                ]);
                $contactoEmpresaPropuesta->save();
            } else {
                // Actualizar el que ya existe
                $propuesta->set_contacto(1,$request->input('contactoVentaId'));
            }
        } else {
            if ($propuesta->get_contacto_empresa_propuesta(1) != null) {
                // Eliminar el que ya existe
                $propuesta->del_contacto(1);
            }
        }
        //Almacenar contacto coordinacion empresa
        if ($request->input('contactoCoordinacionId') != null) {
            if ($propuesta->get_contacto_empresa_propuesta(2) == null) {
                //Almacenar nuevo contacto empresa
                $contactoEmpresaPropuesta = new ContactoEmpresaPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'contacto_empresa_id' => $request->input('contactoCoordinacionId'),
                    'tipo_contacto_id' => 2 //contacto Coordinacion
                ]);
                $contactoEmpresaPropuesta->save();
            } else {
                // Actualizar el que ya existe
                $propuesta->set_contacto(2,$request->input('contactoCoordinacionId'));
            }
        } else {
            if ($propuesta->get_contacto_empresa_propuesta(2) != null) {
                // Eliminar el que ya existe
                $propuesta->del_contacto(2);
            }
        }
        //Almacenar contacto administracion y finanzas empresa
        if ($request->input('contactoAdministracionId') != null) {
            if ($propuesta->get_contacto_empresa_propuesta(3) == null) {
                //Almacenar nuevo contacto empresa
                $contactoEmpresaPropuesta = new ContactoEmpresaPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'contacto_empresa_id' => $request->input('contactoAdministracionId'),
                    'tipo_contacto_id' => 3 //contacto Administracion y finazas
                ]);
                $contactoEmpresaPropuesta->save();
            } else {
                // Actualizar el que ya existe
                $propuesta->set_contacto(3,$request->input('contactoAdministracionId'));
            }
        } else {
            if ($propuesta->get_contacto_empresa_propuesta(3) != null) {
                // Eliminar el que ya existe
                $propuesta->del_contacto(3);
            }
        }
    }

    /**
     * Descargar el archivo de un documento.
     *
     * @param  array  $ids
     * @return \Illuminate\Http\Response
     */
    public function descargarDocumento($id)
    {
        $documento= new Documento;
        $documento=$documento->get_documento($id);
        $hashName=$documento->hash_file_name;
        $nombre=$documento->file_name;
        //Obtener tipo
        $tipo=$documento->tipo_documento();
        $nombreTipo=$tipo->nombre_snake;
        $file= storage_path()."/app/public/documentos/documentos_servicio/".$nombreTipo."/".$hashName;
        return response()->download($file,$nombre);
    }

    /**
     * Descargar una estructura de un Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargarEstructura($id)
    {
        $estructura= new Estructura;
        $estructura=$estructura->get_estructura($id);
        $hashName=$estructura->hash_file_name;
        $nombre=$estructura->file_name;
        $file= storage_path()."/app/public/documentos/estructura_cursos/".$hashName;
        return response()->download($file,$nombre);
    }

    /**
     * Despliega vista para generar diplomas de un Servicio.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diplomaPorServicio($id){
        $servicio= new Servicio();
        $formateador= new Comun();
        $servicio=$servicio->get_servicio($id);
        $fecha='el '.$formateador->fechaFormatoPalabras($servicio->fecha_ejecucion);
        $participantes=$servicio->participantes();
        $curso=$servicio->curso();
        $datosParticipantes= array();
        foreach ($participantes as $participante){
            $datosParticipante= $servicio->get_participante($participante->id);
            if($datosParticipante==null){
                $datosParticipante= new \stdClass();
                $datosParticipante->nombre=$participante->nombre." ".$participante->apellido;
                $datosParticipante->rut=$participante->rut;
                $datosParticipante->asistencia=0;
                $datosParticipante->avg_nota=1.0;
            }else{
                $datosParticipante->asistencia=$datosParticipante->asistencia*100;
            }
            //estado
            if($datosParticipante->asistencia>=75 && $datosParticipante->avg_nota>=6){
                $datosParticipante->estado="Aprobación con Distinción";
            }else{
                if($datosParticipante->asistencia>=75 && $datosParticipante->avg_nota>=4 && $datosParticipante->avg_nota<6){
                    $datosParticipante->estado="Aprobación";
                }else{
                    if(($datosParticipante->asistencia>=50 && $datosParticipante->avg_nota<4)||($datosParticipante->asistencia<75 &&$datosParticipante->asistencia>=50 && $datosParticipante->avg_nota>=4)){
                        $datosParticipante->estado="Participación";
                    }else{
                        $datosParticipante->estado="Reprobación";
                    }
                }
            }
            array_push($datosParticipantes,$datosParticipante);
        }
        $datosJsonParticipantes= json_encode($datosParticipantes);
        return view('servicio.diplomas.diploma_servicio')
            ->with(compact('servicio'))
            ->with(compact('curso'))
            ->with(compact('fecha'))
            ->with(compact('datosParticipantes'))
            ->with(compact('datosJsonParticipantes'));
    }


    /**
     * Generar  diplomas de los Participantes de un Servicio.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function diplomaPorServicioGenerar(Request $request){
        $participantes=$request->input('participantes');
        $fecha=$request->input('fecha');
        $tipoFondo=$request->input('tipo_fondo');
        $fondoSiNo=$request->input('fondo_si_no');
        if($fondoSiNo==0){
            $fondoSiNo=false;
        }else{
            $fondoSiNo=true;
        }
        $nombreProgramaCurso=$request->input('nombre_programa_curso');
        $leyenda=$request->input('leyenda');
        $generador= new GenerarDiplomas();
        $generador->downloadDiploma($fecha,$participantes,$tipoFondo,$fondoSiNo,'"'.$nombreProgramaCurso.'"',$leyenda,'Taller');
    }


    /**
     * Despliega vista para generar diplomas de un Programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diplomaPorPrograma($id){
        $propuesta= new Propuesta();
        $formateador= new Comun();
        $propuesta=$propuesta->get_propuesta($id);
        $fecha='desde el '.$formateador->fechaFormatoPalabras($propuesta->get_first_servicio()).' hasta el '.$formateador->fechaFormatoPalabras($propuesta->get_last_servicio());
        $programa=$propuesta->programa();
        $cantidadCursos=count($programa->cursos());
        $participantes=$propuesta->get_participantes();
        $datosParticipantes= array();
        foreach ($participantes as $participant){
            $participante= new Participante();
            $participante=$participante->get_participante($participant->participante_id);
            $servicio= new Servicio();
            $datosParticipante= new \stdClass();
            $datos=$participante->get_datos_programa($id);
            $asistencia=0;
            $promedio=0;
            $cantidad=0;
            foreach ($datos as $dato){
                $cantidad= $cantidad +1;
                $servicio=$servicio->get_servicio($dato->servicio_id);
                $asistenciaYPromedio=$servicio->get_participante($dato->participante_id);
                if($asistenciaYPromedio!=null){
                    $datosParticipante->nombre=$asistenciaYPromedio->nombre;
                    $datosParticipante->rut=$asistenciaYPromedio->rut;
                    $asistencia= $asistencia+ $asistenciaYPromedio->asistencia;
                    $promedio= $promedio + $asistenciaYPromedio->avg_nota;
                }else{
                    $datosParticipante->nombre=$participante->nombre." ".$participante->apellido;
                    $datosParticipante->rut=$participante->rut;
                    $promedio++;
                }
            }
            if($cantidad==0){
                $asistencia=0;
                $promedio=1.0;
            }else{
                $asistencia=$asistencia/$cantidadCursos;
                $promedio=$promedio+$cantidadCursos-$cantidad;
                $promedio=$promedio/$cantidadCursos;
            }
            $datosParticipante->asistencia=$asistencia*100;
            $datosParticipante->avg_nota=$promedio;
            //estado
            if($datosParticipante->asistencia>=75 && $datosParticipante->avg_nota>=6){
                $datosParticipante->estado="Aprobación con Distinción";
            }else{
                if($datosParticipante->asistencia>=75 && $datosParticipante->avg_nota>=4 && $datosParticipante->avg_nota<6){
                    $datosParticipante->estado="Aprobación";
                }else{
                    if(($datosParticipante->asistencia>=50 && $datosParticipante->avg_nota<4)||($datosParticipante->asistencia<75 &&$datosParticipante->asistencia>=50 && $datosParticipante->avg_nota>=4)){
                        $datosParticipante->estado="Participación";
                    }else{
                        $datosParticipante->estado="Reprobación";
                    }
                }
            }
            array_push($datosParticipantes,$datosParticipante);
        }
        $datosJsonParticipantes= json_encode($datosParticipantes);
        return view('servicio.diplomas.diploma_programa')
            ->with(compact('propuesta'))
            ->with(compact('programa'))
            ->with(compact('fecha'))
            ->with(compact('datosParticipantes'))
            ->with(compact('datosJsonParticipantes'));
    }

    /**
     * Generar  diplomas de los Participantes de un Programa.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function diplomaPorProgramaGenerar(Request $request){

        $participantes=$request->input('participantes');
        $fecha=$request->input('fecha');
        $tipoFondo=$request->input('tipo_fondo');
        $fondoSiNo=$request->input('fondo_si_no');
        if($fondoSiNo==0){
            $fondoSiNo=false;
        }else{
            $fondoSiNo=true;
        }
        $nombreProgramaCurso=$request->input('nombre_programa_curso');
        $leyenda=$request->input('leyenda');
        $generador= new GenerarDiplomas();
        $generador->downloadDiploma($fecha,$participantes,$tipoFondo,$fondoSiNo,'"'.$nombreProgramaCurso.'"',$leyenda,'Programa');
    }

    /**
     * Abrir pdf de diplomas de los Participantes e una nueva pestaña/ventana.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function abrirPdfDiplomas(){
        // Header content type
        header('Content-type: application/pdf');

        header('Content-Disposition: inline; filename="Diplomas Servicios.pdf"');

        header('Content-Transfer-Encoding: binary');

        header('Accept-Ranges: bytes');

        // Read the file
        @readfile(storage_path().'/app/public/documentos/diplomas/Diplomas Servicios.pdf');
        //borrar archivo
        unlink(storage_path().'/app/public/documentos/diplomas/Diplomas Servicios.pdf');

    }

    /**
     * Genera Reporte básico de un Servicio.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generarReporteBasico($id){
        $servicio= new Servicio();
        $servicio=$servicio->get_servicio($id);
        $check= new GenerarResumenServicio();
        $check->downloadResumenServicio($servicio);
    }

    /**
     * Genera gafetes de los participantes de un Servicio.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generarGafetes($id){
        $servicio= new Servicio();
        $servicio=$servicio->get_servicio($id);
        $testGafete= new GenerarGafetes();
        $testGafete->downloadGafetesServicio($servicio);
    }

    /**
     * Genera un Excel con los dtaos de los participantes de un Programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportarDatosParticipantesPrograma($id){
        $check= new ExportarDatosParticipantesPrograma();
        $check->downloadDatosParticipantesPrograma($id);
    }


    /**
     * Descargar Checklist de un Servicio.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function checklistServicio($id){
        $servicio= new Servicio();
        $servicio= $servicio->get_servicio($id);
        $check= new GenerarChecklist();
        $check->downloadChecklist($servicio);
    }


    /**
     * Mostrar la vista para realizar el disenio tecnico de un servicio.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function disenioTecnico($id)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($id);

        //Obtener los relatores
        $relator = new Relator;
        $relatores = $relator->get_relatores();
        $relatoresJson = json_encode($relatores);

        // Obtener contactos otic
        $documento = new Documento();

        return view('servicio.disenio_tecnico')
            ->with(compact('documento'))
            ->with(compact('relatoresJson'))
            ->with(compact('servicio'));
    }


    /**
     * Guardar el disenio tecnico del curso.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarDisenioTecnico(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $servicio->update([
            'relator_id' => $request->input('relator')
        ]);

        $disenio_tecnico = $servicio->diseno_tecnico();

        $disenio_tecnico->update([
            'manual_aplica' => $request->input('aplicaManuales'),
            'prueba_aplica' => $request->input('aplicaPruebas'),
            'guia_aplica' => $request->input('aplicaGuias'),
            'encuesta_empresa_aplica' => $request->input('aplicaEncuestasEmpresa'),
            'encuesta_adicionales_aplica' => $request->input('aplicaEncuestasAdicionales'),
            'detalle' => $request->input('detalles'),
            'estructura_id' => $request->input('estructura')
        ]);

        $servicio->del_documentos();

        if ($request->input('hayManuales') == 'true') {
            foreach ($request->input('manuales') as $manual) {
                $documentoServicio = new DocumentoServicio([
                    'documento_id' => $manual,
                    'servicio_id' => $servicio->id
                ]);
                $documentoServicio->save();
            }
        }

        if ($request->input('hayPruebas') == 'true') {
            foreach ($request->input('pruebas') as $prueba) {
                $documentoServicio = new DocumentoServicio([
                    'documento_id' => $prueba,
                    'servicio_id' => $servicio->id
                ]);
                $documentoServicio->save();
            }
        }

        if ($request->input('hayGuias') == 'true') {
            foreach ($request->input('guias') as $guia) {
                $documentoServicio = new DocumentoServicio([
                    'documento_id' => $guia,
                    'servicio_id' => $servicio->id
                ]);
                $documentoServicio->save();
            }
        }

        if ($request->input('encuestaAds') != null) {
            $documentoServicio = new DocumentoServicio([
                'documento_id' => $request->input('encuestaAds'),
                'servicio_id' => $servicio->id
            ]);
            $documentoServicio->save();
        }

        if ($request->input('hayEncuestasEmpresa') == 'true') {
            foreach ($request->input('encuestasEmpresa') as $encuestaEmpresa) {
                $documentoServicio = new DocumentoServicio([
                    'documento_id' => $encuestaEmpresa,
                    'servicio_id' => $servicio->id
                ]);
                $documentoServicio->save();
            }
        }

        if ($request->input('hayEncuestasAdicionales') == 'true') {
            foreach ($request->input('encuestasAdicionales') as $encuestaAdicional) {
                $documentoServicio = new DocumentoServicio([
                    'documento_id' => $encuestaAdicional,
                    'servicio_id' => $servicio->id
                ]);
                $documentoServicio->save();
            }
        }
    }


    /**
     * Finalizar el disenio tecnico del curso.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function finalizarDisenioTecnico(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('id'));

        $disenio_tecnico = $servicio->diseno_tecnico();

        $disenio_tecnico->update([
            'diseno_tecnico_listo' => 1
        ]);

        if ($servicio->get_last_etapa()->id == '1') {
            $servicio->set_etapa(2);

            $etapaServicio = new EtapaServicio();
            $etapaServicio = $etapaServicio->get_etapa_servicio(2,$servicio->id);
            $etapaServicio->set_end_update();
        }
    }


    /**
     * Descargar Lista de Asistencia de un Servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function listaAsistenciaServicio($id){
        $servicio= new Servicio();
        $servicio= $servicio->get_servicio($id);
        $check= new GenerarListaAsistencia();
        $check->downloadListaAsistencia($servicio);
    }

    /**
     * Guardar/Actualizar un documento del checklist de un Servicio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDocumentoChecklist(Request $request)
    {
        //verifica si tiene tipo diferente de Otros
        if($request->input('tipo')==4){
            //Almacenar documento
            $documento = new DocumentoChecklist([
                'nombre' => $request->input('nombre'),
                'codigo' => 'temporal',
                'tipo_documento_checklist_id' => $request->input('tipo'),
                'hash_file_name' => 'temporal',
                'file_name' => 'temporal',
                'servicio_id' => $request->input('servicio'),
            ]);
            $documento->save();
            //Asignar código
            $codigo= "CHECK".$documento->id;
            $documento->update([
                'codigo' => $codigo,
            ]);
            return $documento->id;
        }else{
            //Obtener servicio
            $servicio= new Servicio();
            $servicio=$servicio->get_servicio($request->input('servicio'));
            //Obtener documento si es que tiene uno
            $documento=$servicio-> get_documento_checklist_tipo($request->input('tipo'));
            if(sizeof($documento)==0){
                //Almacenar documento
                $documento = new DocumentoChecklist([
                    'nombre' => $request->input('nombre'),
                    'codigo' => 'temporal',
                    'tipo_documento_checklist_id' => $request->input('tipo'),
                    'hash_file_name' => 'temporal',
                    'file_name' => 'temporal',
                    'servicio_id' => $servicio->id,
                ]);
                $documento->save();
                //Asignar código
                $codigo= "CHECK".$documento->id;
                $documento->update([
                    'codigo' => $codigo,
                ]);
                return $documento->id;
            }else{
                return $documento[0]->id;
            }

        }
    }

    /**
     * Guardar/Actualizar archivo de un documento del checklist de un Servicio, dentro de la carpeta tipo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivoChecklist(Request $request, $id)
    {
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Obtener documento
            $documento=new DocumentoChecklist();
            $documento=$documento->get_documento($id);
            //Obtener tipo
            $tipo=$documento->tipo_documento_checklist();
            $nombreTipo=$tipo->nombre_snake;
            if($documento->file_name!="temporal"){
                //Borrar antiguo archivo
                unlink(storage_path().'/app/public/documentos/documentos_servicio/documentos_checklist/'.$nombreTipo.'/'.$documento->hash_file_name);
            }
            //Guardar nueva estructura
            $request->file('file')->store('public/documentos/documentos_servicio/documentos_checklist/'.$nombreTipo.'/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $documento->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
    }

    /**
     * Descargar el archivo de un documento único del checklist de un Servicio.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadArchivoChecklist($id,$tipo)
    {
        //Obtener servicio
        $servicio= new Servicio();
        $servicio=$servicio->get_servicio($id);
        //Obtener documento si es que tiene uno
        $documento=$servicio-> get_documento_checklist_tipo($tipo);
        if(sizeof($documento)==0){
            return;
        }else{
            $documento=$documento[0];
        }
        $hashName=$documento->hash_file_name;
        $nombre=$documento->file_name;
        //Obtener tipo
        $tipo=$documento->tipo_documento_checklist();
        $nombreTipo=$tipo->nombre_snake;
        $file= storage_path()."/app/public/documentos/documentos_servicio/documentos_checklist/".$nombreTipo."/".$hashName;
        return response()->download($file,$nombre);
    }


    /**
     * Descargar un archivo del checklist de tipo otros
     *
     * @param str $hash_file_name
     * @return \Illuminate\Http\Response
     */
    public function descargarArchivoOtros($hash_file_name, $file_name)
    {
        return response()->download(storage_path().'/app/public/documentos/documentos_servicio/documentos_checklist/otros/'.$hash_file_name, $file_name);
    }

    /**
     * Eliminar un archivo del checklist de tipo otros
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function eliminarArchivoOtros(Request $request)
    {
        $documentoChecklist = new DocumentoChecklist();
        $documentoChecklist = $documentoChecklist->get_documento($request->input('idArchivo'));

        //eliminar documento del storage
        unlink(storage_path().'/app/public/documentos/documentos_servicio/documentos_checklist/otros/'.$documentoChecklist->hash_file_name);

        //eliminar documento de la base de datos
        $documentoChecklist->delete();
    }


    /**
     * Mostrar la vista para el ingreso de participantes.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ingresarParticipantes($id)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($id);

        $participantes = $servicio->get_participante_select();

        // Agregar notas a los participantes
        for ($i = 0; $i < count($participantes); $i++) {
            $participante = new Participante();
            $participante = $participante->get_participante_rut($participantes[$i]['rut']);
            // obtener test
            $tests = $participante->get_evaluacion_participante_tipo($servicio->id, 'test');
            if (count($tests) != 0){
                $test = $tests[0];
            } else {
                $test = '';
            }
            $participantes[$i]['test'] = str_replace('.',',',$test);
            // obtener retest
            $retests = $participante->get_evaluacion_participante_tipo($servicio->id, 'retest');
            if (count($retests) != 0){
                $retest = $retests[0];
            } else {
                $retest = '';
            }
            $participantes[$i]['retest'] = str_replace('.',',',$retest);
            // obtener guias
            $guias = $participante->get_evaluacion_participante_tipo($servicio->id, 'guia');
            // agregar guias al participante
            for ($j = 0; $j < count($guias); $j++) {
                $participantes[$i]['g'.$j] = str_replace('.',',',$guias[$j]);
            }
            // rellenar con vacios para que la tabla mantenga su estructura
            for ($j = count($guias); $j < 5; $j++) {
                $participantes[$i]['g'.$j] = '';
            }
            // obtener pruebas
            $pruebas = $participante->get_evaluacion_participante_tipo($servicio->id, 'prueba');
            // agregar pruebas al participante
            for ($j = 0; $j < count($pruebas); $j++) {
                $participantes[$i]['p'.$j] = str_replace('.',',',$pruebas[$j]);
            }
            // reelenar con vacios para que la tabla mantenga su estructura
            for ($j = count($pruebas); $j < 5; $j++) {
                $participantes[$i]['p'.$j] = '';
            }
            // obtener evaluaciones
            $evaluaciones = $participante->get_evaluacion_participante_tipo($servicio->id, 'evaluacion');
            // agregar evaluaciones al participante
            for ($j = 0; $j < count($evaluaciones); $j++) {
                $participantes[$i]['e'.$j] = str_replace('.',',',$evaluaciones[$j]);
            }
            // reelenar con vacios para que la tabla mantenga su estructura
            for ($j = count($evaluaciones); $j < 5; $j++) {
                $participantes[$i]['e'.$j] = '';
            }
        }

        for ($i = count($participantes); $i < 25; $i++) {
            $participantes[$i] = ((object)[
                'nombre' => '',
                'apellido' => '',
                'rut' => '',
                'correo' => '',
                'faena' => '',
                'perfil' => '',
                'vigencia' => '',
                'asistencia' => '',
                'test' => '',
                'retest' => '',
                'g0' => '',
                'g1' => '',
                'g2' => '',
                'g3' => '',
                'g4' => '',
                'p0' => '',
                'p1' => '',
                'p2' => '',
                'p3' => '',
                'p4' => '',
                'e0' => '',
                'e1' => '',
                'e2' => '',
                'e3' => '',
                'e4' => ''
            ]);
        }

        $headers = ['Nombre','Apellido','RUT','Correo Electrónico','Faena', 'Perfil','Vigencia','Asistencia','Test','Retest','G 1','G 2','G 3','G 4','G 5','P 1','P 2','P 3','P 4','P 5','E 1','E 2','E 3','E 4','E 5'];

        $headers = json_encode($headers);

        $participantes = json_encode($participantes);

        // Obtener perfiles
        $perfil = new ParticipantePerfil();
        $perfiles = $perfil->get_nombres_participante_perfiles();
        $perfiles = json_encode($perfiles);

        return view('servicio.ingresar_participantes')
            ->with(compact('headers'))
            ->with(compact('participantes'))
            ->with(compact('perfiles'))
            ->with(compact('servicio'));
    }

    /**
     * Guardar participantes.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarParticipantes(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicio_id'));

        $participantes = $request->input('data');

        $rutParticipantes = [];

        foreach($participantes as $participante) {

            if ($participante['nombre'] != '') {

                array_push($rutParticipantes,$participante['rut']);

                $nuevoParticipante = new Participante();

                $nuevoParticipante = $nuevoParticipante->get_participante_rut($participante['rut']);

                if ($nuevoParticipante != '') {

                    $nuevoParticipante->update([
                        'nombre' => $participante['nombre'],
                        'apellido' => $participante['apellido'],
                        'correo' => $participante['correo'],
                        'faena' => $participante['faena'],
                    ]);

                } else {

                    $nuevoParticipante = new Participante([
                        'nombre' => $participante['nombre'],
                        'apellido' => $participante['apellido'],
                        'rut' => $participante['rut'],
                        'correo' => $participante['correo'],
                        'faena' => $participante['faena'],
                    ]);
                    $nuevoParticipante->save();

                }

                $servicio->del_evaluacion_participante($nuevoParticipante->id);

                $servicio->del_participante_servicio($nuevoParticipante->id);

                if ($participante['perfil'] == '') {
                    $participante['perfil'] = 'No determinado';
                }

                $participanteServicio = new ParticipanteServicio([
                    'servicio_id' => $servicio->id,
                    'participante_id' => $nuevoParticipante->id,
                    'vigencia' => $participante['vigencia'],
                    'asistencia' => $participante['asistencia'],
                    'perfil_participante' => $participante['perfil'],
                ]);
                $participanteServicio->save();

                if ($participante['test'] != '') {
                    $test = new Evaluacion([
                        'nota' => str_replace(',','.',$participante['test']),
                        'participante_servicio_id' => $participanteServicio->id,
                        'tipo' => 'test'
                    ]);
                    $test->save();
                }

                if ($participante['retest'] != '') {
                    $retest = new Evaluacion([
                        'nota' => str_replace(',','.',$participante['retest']),
                        'participante_servicio_id' => $participanteServicio->id,
                        'tipo' => 'retest'
                    ]);
                    $retest->save();
                }

                for ($i = 0; $i < 5; $i++) {
                    if ($participante['g'.$i] != '') {
                        $evaluacion = new Evaluacion([
                            'nota' => str_replace(',','.',$participante['g'.$i]),
                            'participante_servicio_id' => $participanteServicio->id,
                            'tipo' => 'guia'
                        ]);
                        $evaluacion->save();
                    }
                }

                for ($i = 0; $i < 5; $i++) {
                    if ($participante['p'.$i] != '') {
                        $evaluacion = new Evaluacion([
                            'nota' => str_replace(',','.',$participante['p'.$i]),
                            'participante_servicio_id' => $participanteServicio->id,
                            'tipo' => 'prueba'
                        ]);
                        $evaluacion->save();
                    }
                }

                for ($i = 0; $i < 5; $i++) {
                    if ($participante['e'.$i] != '') {
                        $evaluacion = new Evaluacion([
                            'nota' => str_replace(',','.',$participante['e'.$i]),
                            'participante_servicio_id' => $participanteServicio->id,
                            'tipo' => 'evaluacion'
                        ]);
                        $evaluacion->save();
                    }
                }
            }

        }

        // actualizar cantidad de participantes
        $servicio->update([
            'cant_participantes' => count(array_unique($rutParticipantes))
        ]);
    }

    /**
     * Eliminar participantes.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function eliminarParticipante(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicio_id'));

        $participante = new Participante();

        $participante = $participante->get_participante_rut($request->input('rut'));

        $servicio->del_evaluacion_participante($participante->id);

        $servicio->del_participante_servicio($participante->id);
    }


    /**
     * Mostrar la vista para cambiar la etapa del servicio.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function administrarServicio($id)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($id);

        return view('servicio.administrar_servicio')
            ->with(compact('servicio'));
    }

    /**
     * Guardar cambio de etapa del servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reiniciarEtapas(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicioId'));

        $servicio->del_etapas();

        $servicio->set_etapa('1');
    }

    /**
     * Cancelar servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cancelarServicio(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicioId'));

        $servicio->set_estado_operacional('5');
    }

    /**
     * Detener servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function detenerServicio(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicioId'));

        $servicio->set_estado_operacional('3');
    }

    /**
     * Reanudar servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reanudarServicio(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicioId'));

        $servicio->set_estado_operacional('1');

        $servicio->update([
            'fecha_ejecucion' => $request->input('fecha_ejecucion')
        ]);

        //Obtener usuarios
        $usuario= new User();
        $usuarios= $usuario->get_users();

        //NOTIFICAR A TODOS LOS USUARIOS DEL SERVICIO REANUDADO
        foreach ($usuarios as $usuario){
            if($usuario->has_rol('Gestor de Servicios')){
                $notificacion= new Notificacion([
                    'mensaje' => 'Se ha reanudado el Servicio '.$servicio->ot,
                    'direccion' => '/servicio/checklist/'.$servicio->id,
                    'tipo' => 'Aviso',
                    'leido_si_no' => false,
                    'user_id' => $usuario->id,
                ]);
                $notificacion->save();
            }
        }
    }

    /**
     * Mostrar la vista para cambiar ingresar las encuestas ADS del servicio.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ingresarEncuestasADS($id)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($id);

        $encuestasBd = $servicio->encuesta_ads();

        $encuestas = [];

        // Agregar valores de las encuestas
        for ($i = 0; $i < count($encuestasBd); $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $encuestas[$i]['r'.$j] = $encuestasBd[$i]['respuesta_'.$j];
            }
        }

        for ($i = count($encuestasBd); $i < $servicio->cant_participantes; $i++) {
            $encuestas[$i] = ((object)[
                'r1' => '',
                'r2' => '',
                'r3' => '',
                'r4' => '',
                'r5' => '',
                'r6' => '',
                'r7' => ''
            ]);
        }

        $encuestas = json_encode($encuestas);

        return view('servicio.ingresar_encuestas_ads')
            ->with(compact('servicio'))
            ->with(compact('encuestas'));
    }

    /**
     * Guardar datos de las encuestas ADS del servicio.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarEncuestasADS(Request $request)
    {
        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($request->input('servicio_id'));

        $encuestas = $request->input('data');

        $servicio->del_encuesta_ads();

        foreach($encuestas as $encuesta) {

            if ($encuesta['r1'] != '') {

                $encuestaADS = new EncuestaAds([
                    'servicio_id' => $servicio->id,
                    'respuesta_1' => $encuesta['r1'],
                    'respuesta_2' => $encuesta['r2'],
                    'respuesta_3' => $encuesta['r3'],
                    'respuesta_4' => $encuesta['r4'],
                    'respuesta_5' => $encuesta['r5'],
                    'respuesta_6' => $encuesta['r6'],
                    'respuesta_7' => $encuesta['r7'],
                ]);
                $encuestaADS->save();

            }

        }
    }

}
