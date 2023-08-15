<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\CheckCierre;
use App\Models\CheckCoordinacion;
use App\Models\DisenoTecnico;
use App\Models\CheckMaterialParticipante;
use App\Models\CheckMaterialRelator;
use App\Models\ContactoEmpresa;
use App\Models\ContactoEmpresaPropuesta;
use App\Models\ContactoOtic;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\EstadoPropuesta;
use App\Models\Notificacion;
use App\Models\Programa;
use App\Models\Propuesta;
use App\Models\Estado;
use App\Models\Motivo;
use App\Models\DocumentoPropuesta;
use App\Models\Ciudad;
use App\Models\Relator;
use App\Models\Servicio;
use App\Models\Urgencia;
use App\Models\ComplejidadGrupo;
use App\Models\ParticipantePerfil;
use App\Models\FocoIntervencion;
use App\Models\ParticipantePerfilPropuesta;
use App\Models\FocoIntervencionPropuesta;
use App\Models\CheckOutdoor;
use App\Models\CheckAudioIluminacion;
use App\Models\User;
use Illuminate\Http\Request;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propuesta = new Propuesta();
        $propuestas = $propuesta->get_propuestas();

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Obtener empresas
        $empresa = new Empresa();
        $empresas = $empresa->get_all_empresas();
        $empresasJson = json_encode($empresas);

        // Obtener programas
        $programa = new Programa();
        $programas = $programa->get_all_programas();
        $programasJson = json_encode($programas);

        // Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_all_cursos();
        $cursosJson = json_encode($cursos);

        // Obtener estados
        $estado = new Estado();
        $estados = $estado->get_estados();
        $estadosJson = json_encode($estados);

        // Obtener motivos
        $motivo = new Motivo();
        $motivos = $motivo->get_motivos();
        $motivosJson = json_encode($motivos);

        return view('propuesta.index')
            ->with(compact('fechaActual'))
            ->with(compact('empresasJson'))
            ->with(compact('programasJson'))
            ->with(compact('cursosJson'))
            ->with(compact('estadosJson'))
            ->with(compact('motivosJson'))
            ->with(compact('propuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propuesta = new Propuesta();

        // Obtener el valor UF de la ultima propuesta creada
        $ultimoValorUf = $propuesta->get_last_uf_hora();

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Obtener areas
        $area = new Area();
        $areas = $area->get_areas();
        $areasJson = json_encode($areas);

        // Obtener empresas
        $empresa = new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        $contactoEmpresa = new ContactoEmpresa();
        $contactosEmpresa = $contactoEmpresa->get_contactos();
        $contactosEmpresaJson = json_encode($contactosEmpresa);

        // Obtener contactos empresa --MODIFICAR AL IMPLEMENTAR LA TABLA contacto_empresa_propuesta
        /*$contactosEmpresa = array(
            array(
                'id' => '1',
                'nombre' => 'ContactoEmpresa1'
            ),
            array(
                'id' => '2',
                'nombre' => 'ContactoEmpresa2'
            ),
        );
        $contactosEmpresaJson = json_encode($contactosEmpresa);*/

        // Obtener contactos otic
        $contactoOtic = new ContactoOtic();
        $contactosOtic = $contactoOtic->get_contactos();
        $contactosOticJson = json_encode($contactosOtic);


        // Obtener programas
        $programa = new Programa();
        $programas = $programa->get_programas();
        $programasJson = json_encode($programas);

        // Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_cursos();
        $cursosJson = json_encode($cursos);

        // Obtener urgencias
        $urgencia = new Urgencia();
        $urgencias = $urgencia->get_urgencias();
        $urgenciasJson = json_encode($urgencias);

        // Obtener complejidades
        $complejidad = new ComplejidadGrupo();
        $complejidades = $complejidad->get_complejidad_grupos();
        $complejidadesJson = json_encode($complejidades);

        // Obtener perfiles
        $perfil = new ParticipantePerfil();
        $perfiles = $perfil->get_participante_perfiles();
        $perfilesJson = json_encode($perfiles);

        // Obtener focos
        $foco = new FocoIntervencion();
        $focos = $foco->get_foco_intervenvion();
        $focosJson = json_encode($focos);

        return view('propuesta.create')
            ->with(compact('urgenciasJson'))
            ->with(compact('complejidadesJson'))
            ->with(compact('perfilesJson'))
            ->with(compact('focosJson'))
            ->with(compact('ultimoValorUf'))
            ->with(compact('areasJson'))
            ->with(compact('empresasJson'))
            ->with(compact('contactosEmpresaJson'))
            ->with(compact('contactosOticJson'))
            ->with(compact('programasJson'))
            ->with(compact('cursosJson'))
            ->with(compact('fechaActual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el tipos_servicio_id
        if ($request->input('programa_id') != null) {
            $tipo_servicio_id = 1;
        } else {
            if ($request->input('curso_id') != null) {
                $tipo_servicio_id = 2;
            } else {
                $tipo_servicio_id = null;
            }
        }

        $propuesta = new Propuesta([
            'fecha_propuesta' => $request->input('fecha_propuesta'),
            'fecha_compromiso' => $request->input('fecha_compromiso'),
            'cant_total_horas' => $request->input('cant_total_horas'),
            'monto' => $request->input('monto'),
            'observaciones' => $request->input('observaciones'),
            'idp' => '--',
            'uf_hora' => $request->input('uf_hora'),
            'area_id' => $request->input('area_id'),
            'tipo_servicio_id' => $tipo_servicio_id,
            'programa_id' => $request->input('programa_id'),
            'curso_id' => $request->input('curso_id'),
            'contacto_otic_id' => $request->input('contacto_otic_id'),
            'empresa_id' => $request->input('empresa_id'),
            // 'otic_id' => $request->input('otic_id'),
            'urgencia_id' => $request->input('urgencia_id'),
            'complejidad_grupo_id' => $request->input('complejidad_grupo_id'),
            'experiencia_ads' => $request->input('experiencia_ads'),
            'experiencia_en' => $request->input('experiencia_en'),
            'experiencia_tematica' => $request->input('experiencia_tematica'),
            'observacion_foco' => $request->input('foco_observacion'),
            'fecha_last_estado' =>$request->input('fecha_propuesta'),
        ]);
        $propuesta->save();

        $propuesta->update([
            'idp' => $propuesta->id
        ]);

        //Almacenar estado propuesta
        $estadoPropuesta = new EstadoPropuesta([
            'propuesta_id' => $propuesta->id,
            'estado_id' => 1 //estado: no enviada
        ]);
        $estadoPropuesta->save();

        if ($request->input('contacto_empresa_id') != null) {
            //Almacenar contacto empresa
            $contactoEmpresaPropuesta = new ContactoEmpresaPropuesta([
                'propuesta_id' => $propuesta->id,
                'contacto_empresa_id' => $request->input('contacto_empresa_id'), /// VERIFICAR
                'tipo_contacto_id' => 1 //contacto Venta
            ]);
            $contactoEmpresaPropuesta->save();
        }

        // Ingresar los nuevos
        if ($request->input('hayPerfiles') == 'true') {
            $perfiles = $request->input('perfiles');
            foreach($perfiles as $perfil) {
                //Almacenar perfil de los participantes
                $participantePerfilPropuesta = new ParticipantePerfilPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'participante_perfil_id' => $perfil
                ]);
                $participantePerfilPropuesta->save();
            }
        }

        if ($request->input('hayFocos') == 'true') {
            $focos = $request->input('focos');
            foreach($focos as $foco) {
                //Almacenar focos de los participantes
                $focoIntervencionPropuesta = new FocoIntervencionPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'foco_intervencion_id' => $foco
                ]);
                $focoIntervencionPropuesta->save();
            }
        }

        return $propuesta->id;
    }

    /**
     * Guarda los archivos de la propuesta.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarArchivos(Request $request, $id)
    {
        // Guardar archivo
        if ($request->hasfile('files')) {

            foreach ($request->file('files') as $file) {
                $file->store('public/documentos/archivos_propuestas/');
                $nombre = $file->getClientOriginalName();
                $hashName = $file->hashName();

                $documetoPropuesta = new DocumentoPropuesta([
                    'file_name' => $nombre,
                    'hash_file_name' => $hashName,
                    'propuesta_id' => $id,

                ]);
                $documetoPropuesta->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propuesta  = new Propuesta();
        $propuesta = $propuesta->get_propuesta($id);

        $estado = $propuesta->get_last_estado();
        $motivo = $propuesta->get_last_motivo_estado($estado->id);


        return view('propuesta.show')
            ->with(compact('motivo'))
            ->with(compact('propuesta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propuesta  = new Propuesta();
        $propuesta = $propuesta->get_propuesta($id);

        $estado = $propuesta->get_last_estado();

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Obtener areas
        $area = new Area();
        $areas = $area->get_areas();
        $areasJson = json_encode($areas);

        // Obtener empresas
        $empresa = new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        $contactoEmpresa = new ContactoEmpresa();
        $contactosEmpresa = $contactoEmpresa->get_contactos();
        $contactosEmpresaJson = json_encode($contactosEmpresa);


        // Obtener contactos otic
        $contactoOtic = new ContactoOtic();
        $contactosOtic = $contactoOtic->get_contactos();
        $contactosOticJson = json_encode($contactosOtic);


        // Obtener programas
        $programa = new Programa();
        $programas = $programa->get_programas();
        $programasJson = json_encode($programas);

        // Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_cursos();
        $cursosJson = json_encode($cursos);

        // Obtener urgencias
        $urgencia = new Urgencia();
        $urgencias = $urgencia->get_urgencias();
        $urgenciasJson = json_encode($urgencias);

        // Obtener complejidades
        $complejidad = new ComplejidadGrupo();
        $complejidades = $complejidad->get_complejidad_grupos();
        $complejidadesJson = json_encode($complejidades);

        // Obtener perfiles
        $perfil = new ParticipantePerfil();
        $perfiles = $perfil->get_participante_perfiles();
        $perfilesJson = json_encode($perfiles);

        // Obtener focos
        $foco = new FocoIntervencion();
        $focos = $foco->get_foco_intervenvion();
        $focosJson = json_encode($focos);



        if ($estado->id == 1 || $estado->id == 2 || $estado->id == 4) {
            return view('propuesta.edit')
                ->with(compact('urgenciasJson'))
                ->with(compact('complejidadesJson'))
                ->with(compact('perfilesJson'))
                ->with(compact('focosJson'))
                ->with(compact('propuesta'))
                ->with(compact('areasJson'))
                ->with(compact('empresasJson'))
                ->with(compact('contactosEmpresaJson'))
                ->with(compact('contactosOticJson'))
                ->with(compact('programasJson'))
                ->with(compact('cursosJson'))
                ->with(compact('fechaActual'));
        } else {
            return view('/home');
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
        // Obtener el tipos_servicio_id
        if ($request->input('programa_id') != null) {
            $tipo_servicio_id = 1;
        } else {
            if ($request->input('curso_id') != null) {
                $tipo_servicio_id = 2;
            } else {
                $tipo_servicio_id = null;
            }
        }

        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($id);

        $propuesta->update([
            'fecha_propuesta' => $request->input('fecha_propuesta'),
            'fecha_compromiso' => $request->input('fecha_compromiso'),
            'cant_total_horas' => $request->input('cant_total_horas'),
            'monto' => $request->input('monto'),
            'observaciones' => $request->input('observaciones'),
            //'idp' => '--',
            'uf_hora' => $request->input('uf_hora'),
            'area_id' => $request->input('area_id'),
            'tipo_servicio_id' => $tipo_servicio_id,
            'programa_id' => $request->input('programa_id'),
            'curso_id' => $request->input('curso_id'),
            'contacto_otic_id' => $request->input('contacto_otic_id'),
            'empresa_id' => $request->input('empresa_id'),
            // 'otic_id' => $request->input('otic_id'),
            'urgencia_id' => $request->input('urgencia_id'),
            'complejidad_grupo_id' => $request->input('complejidad_grupo_id'),
            'experiencia_ads' => $request->input('experiencia_ads'),
            'experiencia_en' => $request->input('experiencia_en'),
            'experiencia_tematica' => $request->input('experiencia_tematica'),
            'observacion_foco' => $request->input('foco_observacion'),
            'fecha_last_estado' =>$request->input('fecha_propuesta'),
        ]);

        $propuesta->save();

        //Almacenar contacto venta empresa
        if ($request->input('contacto_empresa_id') != null) {
            if ($propuesta->get_contacto_empresa_propuesta(1) == null) {
                //Almacenar nuevo contacto empresa
                $contactoEmpresaPropuesta = new ContactoEmpresaPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'contacto_empresa_id' => $request->input('contacto_empresa_id'),
                    'tipo_contacto_id' => 1 //contacto Venta
                ]);
                $contactoEmpresaPropuesta->save();
            } else {
                // Actualizar el que ya existe
                $propuesta->set_contacto(1,$request->input('contacto_empresa_id'));
            }
        } else {
            if ($propuesta->get_contacto_empresa_propuesta(1) != null) {
                // Eliminar el que ya existe
                $propuesta->del_contacto(1);
            }
        }

        // Eliminar los perfiles
        $propuesta->del_perfiles();

        if ($request->input('hayPerfiles') == 'true') {

            $perfiles = $request->input('perfiles');
            foreach($perfiles as $perfil) {
                //Almacenar perfil de los participantes
                $participantePerfilPropuesta = new ParticipantePerfilPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'participante_perfil_id' => $perfil
                ]);
                $participantePerfilPropuesta->save();
            }
        }

        // Eliminar los focos
        $propuesta->del_focos();

        if ($request->input('hayFocos') == 'true') {
            $focos = $request->input('focos');
            foreach($focos as $foco) {
                //Almacenar focos de los participantes
                $focoIntervencionPropuesta = new FocoIntervencionPropuesta([
                    'propuesta_id' => $propuesta->id,
                    'foco_intervencion_id' => $foco
                ]);
                $focoIntervencionPropuesta->save();
            }
        }

        return $propuesta->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('id'));

        $archivos = $propuesta->documentos_propuesta();

        foreach ($archivos as $archivo) {
                $documentoPropuesta = new DocumentoPropuesta();
                $documentoPropuesta = $documentoPropuesta->get_documento($archivo->id);

                //eliminar documento del storage
                unlink(storage_path().'/app/public/documentos/archivos_propuestas/'.$documentoPropuesta->hash_file_name);

                //eliminar documento de la base de datos
                $documentoPropuesta->delete();
        }

        //elimniar contacto propuesta
        $propuesta->del_contacto_empresa();
        
        $propuesta->update([
            'last_estado' => 'Eliminada',
            'fecha_last_estado' => date('Y-m-d'),
        ]);
        //eliminar estado propuesta
        $propuesta->del_estado_propuesta();

        //eliminar propuesta
        $propuesta->delete();

    }

    /**
     * Enviar los cursos de un programa
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCursosPrograma(Request $request)
    {
        // Obtener cursos del porgrama
        $programa = new Programa();
        $programa = $programa->get_programa($request->input('programaId'));
        $cursos = $programa->cursos();
        $cursosJson = json_encode($cursos);

        return $cursosJson;
    }

    public function getContactosEmpresa($idEmpresa)
    {
        $empresa = new Empresa();
        $contactoEmpresa = $empresa->contactos_empresa();
        $contactoEmpresaJson = json_encode($contactoEmpresa);

        return $contactoEmpresaJson;
    }

    /**
     * Descargar un archivo de la propuesta
     *
     * @param int $hash_file_name
     * @return \Illuminate\Http\Response
     */
    public function descargarArchivo($hash_file_name, $file_name)
    {
        return response()->download(storage_path().'/app/public/documentos/archivos_propuestas/'.$hash_file_name, $file_name);
    }

    /**
     * Eliminar un archivo de la propuesta
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function eliminarArchivo(Request $request)
    {
        $documentoPropuesta = new DocumentoPropuesta();
        $documentoPropuesta = $documentoPropuesta->get_documento($request->input('idArchivo'));

        //eliminar documento del storage
        unlink(storage_path().'/app/public/documentos/archivos_propuestas/'.$documentoPropuesta->hash_file_name);

        //eliminar documento de la base de datos
        $documentoPropuesta->delete();
    }

    /**
     * Cambiar el estado de la propuesta
     *
     * @param \Illuminate\Http\Request $request
     */
    public function cambiarEstado(Request $request)
    {
        //Almacenar estado propuesta   
        $estadoPropuesta = new EstadoPropuesta([
            'propuesta_id' => $request->input('id'),
            'estado_id' => $request->input('estado_id'),
            'motivo_id' => $request->input('motivo_id')
        ]);

        $estadoPropuesta->save();

        $estado = new Estado();
        $estado = $estado->get_estado($request->input('estado_id'));

        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('id'));
        
        $propuesta->update([
            'last_estado' => $estado->nombre,
            'fecha_last_estado' => $estadoPropuesta->created_at,
        ]);
        
    }

    /**
     * Enviar los contactos de una empresa
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getContactosEmpresaFiltrado(Request $request)
    {
        // Obtener cursos del porgrama
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($request->input('empresaId'));
        $contactosEmpresa = $empresa->contactos_empresa();
        $contactosEmpresaJson = json_encode($contactosEmpresa);

        return $contactosEmpresaJson;
    }

    /**
     * Mostrar la vista para crear nuevos servicios de una propuesta
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function crearServicios($id)
    {
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($id);

        //Obtener las ciudades
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        //Obtener los relatores
        $relator = new Relator;
        $relatores = $relator->get_relatores();
        $relatoresJson = json_encode($relatores);

        return view('propuesta.confirmacion_servicio')
            ->with(compact('ciudadesJson'))
            ->with(compact('relatoresJson'))
            ->with(compact('propuesta'));
    }

    /**
     * Guarda un nuevo servicio
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarServicios(Request $request)
    {
        $servicios = $request->input('servicios');
        $usuario= new User();
        $usuarios= $usuario->get_users();
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($request->input('propuestaId'));

        $propuesta->update([
            'monto_final' => $request->input('montoFinal')
        ]);

        foreach ($servicios as $servicio) {
            if ($servicio !== null) {

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

                // se actulizar monto acumulado en la tabla meta venta.
                $newServicio->update_monto_acumulado($propuesta->empresa_id);

                // asignar etapapropuesta
                $newServicio->set_etapa(1);

                // asignar estado operacional
                $newServicio->set_estado_operacional(1);
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
        }

        //Almacenar estado propuesta
        $estadoPropuesta = new EstadoPropuesta([
            'propuesta_id' => $request->input('propuestaId'),
            'estado_id' => '6'
        ]);

        $estadoPropuesta->save();

        // se calcula monto_venta para la empresa
        $propuesta = new Propuesta();
        $propuesta = $propuesta->get_propuesta($estadoPropuesta->propuesta_id);
        //$propuesta->update_monto_acumulado();

        $estado = new Estado();
        $estado = $estado->get_estado(6);

        $propuesta->update([
            'last_estado' => $estado->nombre,
            'fecha_last_estado' => $estadoPropuesta->created_at,
        ]);
    }

    // /**
    //  * Obtiene todos los servicios de una idP
    //  *
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function obtenerServicios($propuestaId)
    // {
    //     $propuesta = new Propuesta();
    //     $propuesta = $propuesta->get_propuesta($propuestaId);

    //     $servicios = array(
    //         "cursoId"=>"13",
    //         "PropuestaId"=>"1"
    //         ,"nombre"=>"Pedro Carballo",
    //         "numeroHoras"=>null,
    //         "numeroParticipantes"=>null,
    //         "fechaEjecucion"=>"2019-05-24",
    //         "horario"=>null,
    //         "codigoSence"=>null,
    //         "lugar"=>null,
    //         "salon"=>null,
    //         "actividades"=> array(
    //             "coffee"=>"true",
    //             "almuerzo"=>"true",
    //             "outdoor"=>"false",
    //             "encuestaEmpresa"=>"false",
    //             "carpetaRelator"=>"true",
    //             "guias"=>"false",
    //             "bitacora"=>"false",
    //             "carpetaParticipantes"=>"false",
    //             "encuestaAds"=>"true",
    //             "pendones"=>"true",
    //             "pruebas"=>"true",
    //             "lapices"=>"false",
    //             "diplomaCurso"=>"true",
    //             "listaAsistencia"=>"true"
    //         ),
    //         "detalles"=>null
    //     );
    //     return json_encode($servicios);
    // }
}
