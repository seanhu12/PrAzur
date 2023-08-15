<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Webmozart\Assert\Assert;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EtapaServicio;
use DateTime;

class Servicio extends Model
{
    use SoftDeletes;
    protected $table = 'servicios';
    protected $fillable = [
        'ot',
        'nombre',
        'fecha_ejecucion',
        'horario',
        'lugar_realizacion',
        'salon',
        'cant_horas',
        'cant_participantes',
        'orden_compra',
        'detalles',
        'id_accion',
        'horario_coffee_am',
        'horario_coffee_pm',
        'horario_almuerzo',
        'sence_aplica',
        'monto_servicio',
        'observaciones_checklist',
        'outdoor_aplica',
        'outdoor_listo',

        'audio_iluminacion_aplica',
        'certificado_sence',
        'diploma_programa_aplica',
        'logistica_listo',
        'cierre_listo',

        'curso_id',
        'estructura_id',
        'ciudad_id',
        'propuesta_id',
        'relator_id',
        'notebook_id',
        'proyector_id',
        'diseno_tecnico_id',
        'check_material_participante_id',
        'check_material_relator_id',
        'check_sence_id',
        'check_cierre_id',
        'check_audio_iluminacion_id',
        'check_outdoor_id',
        'check_coordinacion_id',
        'last_estado_operacional',
        'last_etapa',
    ];

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class)->withTrashed()->first();
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class)->withTrashed()->first();
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class)/*->withTrashed()*/->first();
    }

    public function relator()
    {
        return $this->belongsTo(Relator::class)->withTrashed()->first();
    }

    public function notebook()
    {
        return $this->belongsTo(Notebook::class)->withTrashed()->first();
    }

    public function proyector()
    {
        return $this->belongsTo(Proyector::class)->withTrashed()->first();
    }

    public function etapas()
    {
        return $this->belongsToMany('App\Models\Etapa')->get();
    }

    public function pendones()
    {
        return $this->belongsToMany('App\Models\Pendon')->withTrashed()->get();
    }

    //obtener id pendones del servicio
    public function get_id_pendones()
    {
        $idPendones = PendonServicio::where('servicio_id', $this->id)->pluck('pendon_id')->toArray();
        return $idPendones;
    }

    public function documentos()
    {
        return $this->belongsToMany('App\Models\Documento')->withTrashed()->get();
    }

    public function estados_operacionales()
    {
        return $this->belongsToMany('App\Models\EstadoOperacional')->get();
    }

    public function participantes()
    {
        return $this->belongsToMany('App\Models\Participante')->get();
    }

    public function participantes_con_select()
    {
        return $this->belongsToMany('App\Models\Participante')
            ->select('nombre', 'apellido', 'rut', 'correo', 'faena')->get();
    }

    public function ordenes_compra()
    {
        return $this->hasMany(OrdenCompra::class)->withTrashed()->get();
    }

    public function get_ordenes_compra()
    {
        return $this->hasMany(OrdenCompra::class)->get();
    }

    public function check_cierre()
    {
        return $this->belongsTo(CheckCierre::class)->first();
    }

    public function check_coordinacion()
    {
        return $this->belongsTo(CheckCoordinacion::class)->first();
    }

    public function diseno_tecnico()
    {
        return $this->belongsTo(DisenoTecnico::class)->first();
    }

    public function check_material_participante()
    {
        return $this->belongsTo(CheckMaterialParticipante::class)->first();
    }

    public function check_material_relator()
    {
        return $this->belongsTo(CheckMaterialRelator::class)->first();
    }

    public function check_sence()
    {
        return $this->belongsTo(CheckSence::class)->first();
    }

    public function check_outdoor()
    {
        return $this->belongsTo(CheckOutdoor::class)->first();
    }

    public function check_audio_iluminacion()
    {
        return $this->belongsTo(CheckAudioIluminacion::class)->first();
    }

    public function documentos_checklist()
    {
        $this->hasMany(DocumentoChecklist::class)->get();
    }

    public function encuesta_ads()
    {
        return $this->HasMany(EncuestaAds::class)->get();
    }

    public function get_servicios()
    {
        $servicios = Servicio::orderBy('fecha_ejecucion', 'desc')->get();

        return $servicios;
    }

    public function get_all_propuestas()
    {
        $servicios = Servicio::withTrashed()->get();

        return $servicios;
    }

    public function get_propuesta($idServicio)
    {
        $servicio = Servicio::withTrashed()->where('id', $idServicio)->first();

        return $servicio;
    }

    public function get_documento_checklist_tipo($idTipo)
    {
        $documentos = DocumentoChecklist::orderBy('id')
            ->where('servicio_id', $this->id)
            ->Where('tipo_documento_checklist_id', $idTipo)->get();

        return $documentos;
    }

    public function set_etapa($idEtapa)
{
    // Creación de la etapa del servicio
    $etapaServicio = new EtapaServicio([
        'servicio_id' => $this->id,
        'etapa_id' => $idEtapa,
    ]);
    $etapaServicio->save();

    // Obtener el nombre de la etapa
    $etapa = Etapa::find($idEtapa);

    // Obtener el servicio usando el método estático find
    $servicio = Servicio::find($this->id);

    // Actualizar el último nombre de etapa en el servicio
    $servicio->update([
        'last_etapa' => $etapa->nombre,
    ]);
}


    public function set_estado_operacional($idEstado)
    {
        $estadoOperacionalServicio = new EstadoOperacionalServicio([
            'servicio_id' => $this->id,
            'estado_operacional_id' => $idEstado,
        ]);
        $estadoOperacionalServicio->save();

        //actualización estado operacional
        $estadoOperacional = new EstadoOperacional();
        $estadoOperacional = $estadoOperacional->get_estado($idEstado);

        $servicio = new Servicio();
        $servicio = $servicio->get_servicio($this->id);

        $servicio->update([
            'last_estado_operacional' => $estadoOperacional->nombre,
        ]);
    }

    public function get_servicio($idServicio)
    {
        $servicio = Servicio::where('id', $idServicio)->first();

        return $servicio;
    }

    public function get_last_estado_operacional()
    {
        //$estado = $this->estados_operacionales()->last();
        $estado = EstadoOperacionalServicio::where('servicio_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $estado->estado_operacional();
    }

    public function get_last_etapa()
    {
        $etapa = EtapaServicio::where('servicio_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $etapa->etapa();
    }

    public function get_documentos_tipo_id($idTipo)
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', $idTipo)->pluck('documento_servicio.documento_id')->toArray();


        //$documentos = $documentos->pluck('documento_servicio.documento_id')->toArray();
        //$documentos = $documentos->pluck('id')->toArray();

        return $documentos;
    }

    public function get_documentos_tipo_codigo($idTipo)
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', $idTipo)->pluck('documentos.codigo')->toArray();

        return $documentos;
    }

    public function get_documentos_tipo($idTipo)
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', $idTipo)
            ->select('documento_servicio.documento_id', 'documentos.nombre', 'documentos.codigo', 'tipo_documentos.nombre AS tipo')->get();


        //$documentos = $documentos->pluck('documento_servicio.documento_id')->toArray();
        //$documentos = $documentos->pluck('id')->toArray();

        return $documentos;
    }

    public function get_encuestas_adicionales_id()
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', 4)
            ->orWhere('tipo_documentos.id', 7)
            ->pluck('documento_servicio.documento_id')->toArray();
        return $documentos;
    }

    public function get_encuestas_adicionales_codigo()
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', 4)
            ->orWhere('tipo_documentos.id', 7)
            ->pluck('documentos.codigo')->toArray();
        return $documentos;
    }

    public function get_encuestas_adicionales()
    {
        $documentos = DocumentoServicio::where('servicio_id', $this->id)
            ->join('documentos', 'documento_servicio.documento_id', '=', 'documentos.id')
            ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
            ->where('tipo_documentos.id', 4)
            ->orWhere('tipo_documentos.id', 7)
            ->select('documento_servicio.documento_id', 'documentos.nombre', 'documentos.codigo', 'tipo_documentos.nombre AS tipo')->get();
        return $documentos;
    }

    public function del_documentos()
    {
        $documentosServicio = DocumentoServicio::where('servicio_id', $this->id)->get();

        if ($documentosServicio != null) {
            foreach ($documentosServicio as $documentoServicio) {
                $documentoServicio->delete();
            }
        }
    }

    public function get_asistencia($idParticipante)
    {
        $estadoPropuesta = ParticipanteServicio::where('servicio_id', $this->id)
            ->where('participante_id', $idParticipante)->first();

        return $estadoPropuesta->asistencia;
    }


    public function del_encuesta_ads()
    {
        $encuestas = EncuestaAds::where('servicio_id', $this->id)
            ->count();
        if ($encuestas != 0) {
            EncuestaAds::where('servicio_id', $this->id)
            ->delete();
        }
    }

    public function get_evaluaciones($idParticipante)
    {
        $estadoPropuesta = ParticipanteServicio::where('servicio_id', $this->id)
            ->where('participante_id', $idParticipante)->first();
        return $estadoPropuesta->evaluaciones();
    }

    public function get_participante($idParticipante)
    {
        $participante = DB::table('evaluacions')
            ->join('participante_servicio', 'evaluacions.participante_servicio_id', '=', 'participante_servicio.id')
            ->join('participantes', 'participante_servicio.participante_id', '=', 'participantes.id')
            ->where('participante_servicio.participante_id', $idParticipante)
            ->where('participante_servicio.servicio_id', $this->id)
            ->where('evaluacions.tipo', '<>', 'test')
            ->where('evaluacions.tipo', '<>', 'retest')
            ->select(DB::raw('CONCAT(nombre ," ", apellido) as nombre'), DB::raw('rut'), DB::raw('vigencia'), DB::raw('asistencia'), DB::raw('avg(evaluacions.nota) as avg_nota'))
            ->groupBy(DB::raw('evaluacions.participante_servicio_id,asistencia,rut,nombre,apellido,vigencia'))
            ->first();

        return $participante;
    }

    public function get_participante_select()
    {

        $participantes = DB::table('participante_servicio')
            ->join('participantes', 'participante_servicio.participante_id', '=', 'participantes.id')
            ->where('participante_servicio.servicio_id', $this->id)
            ->select(DB::raw('nombre'), DB::raw('apellido'), DB::raw('rut'), DB::raw('correo'), DB::raw('faena'), DB::raw('vigencia'), DB::raw('asistencia'),DB::raw('perfil_participante as perfil'))
            ->get()
            ->toArray();
        $array = json_decode(json_encode($participantes), true);

        //$array[0]['nombre']
        return $array;
    }


    public function set_pendones($pendones)
    {
        $pendonsArr = explode(",", $pendones);
        $long = count($pendonsArr);

        //force delete pendones del servicio
        $pendonServicios = PendonServicio::where('servicio_id', $this->id)->get();

        foreach ($pendonServicios as $pendon) {
            $pendon->forceDelete();
        }

        //asignar nuevos pendones al servicio
        for ($i = 0; $i < $long; $i++) {
            $pendonServicio = new PendonServicio([
                'servicio_id' => $this->id,
                'pendon_id' => $pendonsArr[$i],
            ]);

            $pendonServicio->save();
        }
    }

    public function del_pendones()
    {
        //buscar pendones
        $pendonServicio = PendonServicio::where('servicio_id', $this->id)->get();

        //eliminar pendones
        foreach ($pendonServicio as $pedon) {
            $pedon->forceDelete();
        }
    }


    public function get_documentos_checklist_tipo($idTipo)
    {
        $documentos = DocumentoChecklist::where('servicio_id', $this->id)
            ->where('tipo_documento_checklist_id', $idTipo)
            ->get();

        return $documentos;
    }


    public function verificar_ingreso_asistencia()
    {
        $participante_servicio = ParticipanteServicio::where('servicio_id', $this->id)
            ->whereNotNull('asistencia')
            ->count();
        if ($participante_servicio == 0) {
            return 0;
        } else {

            return 1;
        }
    }

    public function verificar_ingreso_encuesta()
    {
        $encuestaAds = EncuestaAds::where('servicio_id', $this->id)
            ->count();

        if ($encuestaAds == 0) {
            return 0;
        } else {

            return 1;
        }
    }

    public function verificar_ingreso_notas()
    { }

    public function verificar_ingreso_oc()
    {
        if ($this->orden_compra == null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function del_participante_servicio($idParticipante)
    {
        $participanteServicio = ParticipanteServicio::where('servicio_id', $this->id)
            ->where('participante_id', $idParticipante)
            ->forceDelete();
    }

    public function del_evaluacion_participante($idParticipante)
    {
        $participantesServicio = ParticipanteServicio::where('servicio_id', $this->id)
            ->where('participante_id', $idParticipante)
            ->get();
        foreach ($participantesServicio as $participanteServicio) {
            $evaluacion = Evaluacion::where('participante_servicio_id', $participanteServicio->id);
            $evaluacion->delete();
        }
    }

    public function get_participante_promedio_tipo($idParticipante, $tipo)
    {
        $participante = DB::table('evaluacions')
            ->join('participante_servicio', 'evaluacions.participante_servicio_id', '=', 'participante_servicio.id')
            ->join('participantes', 'participante_servicio.participante_id', '=', 'participantes.id')
            ->where('participante_servicio.participante_id', $idParticipante)
            ->where('participante_servicio.servicio_id', $this->id)
            ->where('evaluacions.tipo', $tipo)
            ->select(DB::raw('avg(evaluacions.nota) as avg_nota'))
            ->groupBy(DB::raw('evaluacions.participante_servicio_id,asistencia,rut,nombre,apellido'))
            ->first();

        return $participante;
    }

    public function get_indicador_servicio_mes()
    {
        $mes = date('m');
        $año = date('Y');
        $servicios = Servicio::WhereYear('fecha_ejecucion', $año)
            ->whereMonth('fecha_ejecucion', $mes)
            ->count();
        return $servicios;
    }

    public function get_indicador_servicio_atrasado()
    {
        $servicios = Servicio::Where('last_estado_operacional', 'Atrasado')
            ->count();
        return $servicios;
    }

    public function get_indicador_servicio_cierre()
    {
        $servicios = Servicio::Where('last_etapa', 'Cierre')
            ->count();
        return $servicios;
    }

    public function get_indicador_servicios_proximos_dias($dias)
    {
        $fecha_from = date('Y-m-d');
        $fecha_to = date('Y-m-d', strtotime($fecha_from . ' + ' . $dias . ' days'));

        $servicios = Servicio::whereBetween('fecha_ejecucion', [$fecha_from, $fecha_to])
            ->count();

        return $servicios;
    }

    public function del_etapas()
    {
        $etapasServicio = EtapaServicio::where('servicio_id', $this->id)->get();

        foreach ($etapasServicio as $etapaServicio) {
            $etapaServicio->delete();
        }
    }

    public function get_indicador_servicios_por_mes($año,$mes)
    {
        $servicios = Servicio::WhereYear('fecha_ejecucion', $año)
            ->whereMonth('fecha_ejecucion', $mes)
            ->count();
        return $servicios;
    }

    public function get_indicador_servicios_por_etapa($etapa)
    {
        $servicios = Servicio::where('last_etapa',$etapa)
            ->where('last_estado_operacional','<>','Cancelado')
            ->count();
        return $servicios;
    }

    public function update_monto_acumulado($idEmpresa)
{
    try {
        $date = \DateTime::createFromFormat("Y-m-d", $this->fecha_ejecucion);
        $anio = $date->format("Y");
        $mes = $date->format("m");

        $monto_acumulado = Propuesta::where('empresa_id', $idEmpresa)
            ->join('servicios', 'propuestas.id', '=', 'servicios.propuesta_id')
            ->whereYear('servicios.fecha_ejecucion', $anio)
            ->whereMonth('servicios.fecha_ejecucion', $mes)
            ->sum('servicios.monto_servicio');

        $metaVenta = MetasVenta::where('empresa_id', $idEmpresa)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->first();

        // Verificar si $metaVenta existe antes de intentar actualizarlo
        if ($metaVenta) {
            $metaVenta->update([
                'monto_vendido' => $monto_acumulado,
            ]);
        } else {
            // Loggear un mensaje de error si $metaVenta no existe
            \Log::error("Meta de venta no encontrada para empresa: $idEmpresa, año: $anio, mes: $mes");
        }
    } catch (\Exception $e) {
        // Loggear cualquier excepción que ocurra
        \Log::error("Error al actualizar el monto acumulado: " . $e->getMessage());
    }
}

}
