<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propuesta extends Model
{
    use SoftDeletes;
    protected $table = 'propuestas';

    protected $fillable = [
        'fecha_propuesta',
        'fecha_compromiso',
        'cant_total_horas',
        'monto',
        'monto_final',
        'observaciones',
        'idp',
        'uf_hora',
        'experiencia_ads',
        'experiencia_en',
        'experiencia_tematica',
        'area_id',
        'tipo_servicio_id',
        'programa_id',
        'curso_id',
        'contacto_otic_id',
        'empresa_id',
        'otic_id',
        'urgencia_id',
        'complejidad_grupo_id',
        'observacion_foco',
        'last_estado',
        'fecha_last_estado',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class)->first();
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class)->get();
    }

    public function tipo_servicio()
    {
        return $this->belongsTo(TipoServicio::class)->first();
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class)->withTrashed()->first();
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class)->withTrashed()->first();
    }

    public function contacto_otic()
    {
        return $this->belongsTo(ContactoOtic::class)->withTrashed()->first();
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->withTrashed()->first();
    }

    public function otic()
    {
        return $this->belongsTo(Otic::class)->withTrashed()->first();
    }

    public function contactos_empresa()
    {
        return $this->belongsToMany('App\Models\ContactoEmpresa')->withTrashed()->get();
    }

    public function estados()
    {
        return $this->belongsToMany('App\Models\Estado')->get();
    }

    public function documentos_propuesta()
    {
        return $this->hasMany(DocumentoPropuesta::class)->get();
    }

    public function urgencia()
    {
        return $this->belongsTo(Urgencia::class)->first();
    }

    public function complejidad_grupo()
    {
        return $this->belongsTo(ComplejidadGrupo::class)->first();
    }

    public function foco_intervencion()
    {
        return $this->belongsToMany('App\Models\FocoIntervencion')->get();
    }

    public function foco_intervencion_ids()
    {
        return $this->belongsToMany('App\Models\FocoIntervencion')->pluck('foco_intervencion_id')->toArray();
    }

    public function participante_perfil()
    {
        return $this->belongsToMany('App\Models\ParticipantePerfil')->get();
    }

    public function participante_perfil_ids()
    {
        return $this->belongsToMany('App\Models\ParticipantePerfil')->pluck('participante_perfil_id')->toArray();
    }

    public function get_propuestas()
    {
        $propuestas = Propuesta::orderBy('fecha_propuesta','desc')->get();
        //$propuestas = Propuesta::all()->sortByDesc('fecha_propuesta');

        return $propuestas;
    }

    public function get_all_propuestas()
    {
        $propuestas = Propuesta::withTrashed()->get();
        //$propuestas = Propuesta::all()->sortByDesc('fecha_propuesta');

        return $propuestas;
    }

    public function get_propuesta($idPropuesta)
    {
        $propuesta = Propuesta::withTrashed()->where('id', $idPropuesta)->first();

        return $propuesta;
    }

    public function get_propuestas_confirmadas()
    {
        $propuestas = EstadoPropuesta::whereNotNull('estado_propuesta.id')
            ->join('propuestas', 'estado_propuesta.propuesta_id', '=', 'propuestas.id')
            ->where('estado_propuesta.estado_id', 6)
            ->get();

        return $propuestas;
    }

    public function get_last_uf_hora()
    {

        if (Propuesta::all()->count() == 0) {
            return 0;

        } else {

            return Propuesta::all()->last()->uf_hora;
        }

    }

    public function get_last_estado()
    {
        $estado= EstadoPropuesta::where('propuesta_id', $this->id)
            ->orderBy('created_at','desc')
            ->first();

        return $estado->estado();
    }

    public function get_last_estado_propuesta()
    {
        $estado= EstadoPropuesta::where('propuesta_id', $this->id)
            ->orderBy('created_at','desc')
            ->first();

        return $estado;
    }

    public function get_last_motivo_estado($idEstado)
    {
        $estadoPropuesta = EstadoPropuesta::where('estado_id', $idEstado)
            ->where('propuesta_id', $this->id)->first();

        if ($estadoPropuesta->motivo_id == null) {
            return null;
        } else {
            return $estadoPropuesta->motivo();
        }
    }

    public function get_contacto($idTipoContacto)
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)->where('tipo_contacto_id', $idTipoContacto)->first();
        if ($contactoEmpresaPropuesta != null) {
            $contactoEmpresa = ContactoEmpresa::where('id', $contactoEmpresaPropuesta->contacto_empresa_id)->first();

            return $contactoEmpresa;
        } else {
            return null;
        }

    }

    public function get_contacto_empresa_propuesta($idTipoContacto)
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)->where('tipo_contacto_id', $idTipoContacto)->first();

        return $contactoEmpresaPropuesta;

    }

    public function get_contactos()
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)->get();

        return $contactoEmpresaPropuesta;

    }

    public function set_contacto($idTipoContacto, $idContactoEmpresa)
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)
            ->where('tipo_contacto_id', $idTipoContacto)->first();

        $contactoEmpresaPropuesta->update(['contacto_empresa_id' => $idContactoEmpresa]);
    }

    public function del_contacto($idTipoContacto)
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)
            ->where('tipo_contacto_id', $idTipoContacto)->first();

        $contactoEmpresaPropuesta->delete();
    }

    public function del_contacto_empresa()
    {
        $contactoEmpresaPropuesta = ContactoEmpresaPropuesta::where('propuesta_id', $this->id)->get();

        if ($contactoEmpresaPropuesta != null) {
            foreach ($contactoEmpresaPropuesta as $contactoEmpresa) {
                $contactoEmpresa->delete();
            }
        }
    }

    public function del_estado_propuesta()
    {
        $estadoPropuesta = EstadoPropuesta::where('propuesta_id', $this->id)->get();

        if ($estadoPropuesta != null) {
            foreach ($estadoPropuesta as $estado) {
                $estado->delete();
            }
        }
    }

    public function del_focos()
    {
        //buscar focos antiguos
        $focosPropuesta = FocoIntervencionPropuesta::where('propuesta_id', $this->id)->get();

        //eliminar focos antiguos
        if ($focosPropuesta != null) {
            //eliminar focos antiguos
            foreach ($focosPropuesta as $foco) {
                $foco->delete();
            }
        }
    }

    public function del_perfiles()
    {
        //buscar perfiles antiguos
        $perfilPropuesta = ParticipantePerfilPropuesta::where('propuesta_id', $this->id)->get();

        //eliminar perfiles antiguos
        if ($perfilPropuesta != null) {
            //eliminar perfiles antiguos
            foreach ($perfilPropuesta as $perfil) {
                $perfil->delete();
            }
        }
    }

   /* public function update_monto_acumulado()
    {
        $date = DateTime::createFromFormat("Y-m-d", $this->fecha_compromiso);
        $anio=$date->format("Y");
        $mes=$date->format("m");
        $monto_acumulado = Propuesta::where('empresa_id',$this->empresa_id)
            ->join('estado_propuesta','propuestas.id','=','estado_propuesta.propuesta_id')
            ->where('estado_propuesta.estado_id',6)
            ->whereYear('propuestas.fecha_compromiso', $anio)
            ->whereMonth('propuestas.fecha_compromiso', $mes)
            ->sum('propuestas.monto_final');

        //$metaVenta = $this->empresa()->get_meta_venta($anio,$mes);

        $metaVenta = MetasVenta::where('empresa_id',$this->empresa_id)
        ->where('anio',$anio)
        ->where('mes',$mes)
        ->first();

        //revisar si se debe agregar una excepción para ventas que no existan
        $metaVenta->update([
            'monto_vendido' => $monto_acumulado,
        ]);

        //return $monto_acumulado;
    } */

    public function get_participantes()
    {
        $participantes = Servicio::where('propuesta_id',$this->id)
            ->join('participante_servicio','servicios.id','=','participante_servicio.servicio_id')
            ->join('participantes','participante_servicio.participante_id','participantes.id')
            ->select('participantes.id as participante_id')
            ->distinct()
            ->get();

        return $participantes;
    }

    public function get_last_servicio2()
    {

        if (Propuesta::all()->count() == 0) {
            return 0;

        } else {

            return Propuesta::all()->last()->uf_hora;
        }

    }

    public function get_last_servicio()
    {
        $fecha = Servicio::where('propuesta_id',$this->id)->orderBy('fecha_ejecucion', 'desc')->pluck('fecha_ejecucion')->first();

        return $fecha;
    }

    public function get_first_servicio()
    {
        $fecha = Servicio::where('propuesta_id',$this->id)->orderBy('fecha_ejecucion', 'asc')->pluck('fecha_ejecucion')->first();

        return $fecha;
    }

    public function get_propuestas_por_estado($idestado)
    {
        $propuestas = EstadoPropuesta::whereNotNull('estado_propuesta.id')
            ->join('propuestas', 'estado_propuesta.propuesta_id', '=', 'propuestas.id')
            ->where('estado_propuesta.estado_id', $idestado)
            ->get();

        return $propuestas;
    }

    public function get_indicador_propuesta_confirmadas_mes()
    {
        $mes = date('m');
        $año = date('Y');
        
        $propuestas = EstadoPropuesta::whereNotNull('estado_propuesta.id')
            ->join('propuestas', 'estado_propuesta.propuesta_id', '=', 'propuestas.id')
            ->where('estado_propuesta.estado_id', 6)
            ->WhereYear('propuestas.fecha_last_estado', $año)
            ->whereMonth('propuestas.fecha_last_estado', $mes)
            ->count();
            
        return $propuestas;
    }

    public function get_indicador_propuesta_enviada_mes()
    {
        $mes = date('m');
        $año = date('Y');

        $propuestas = EstadoPropuesta::whereNotNull('estado_propuesta.id')
            ->join('propuestas', 'estado_propuesta.propuesta_id', '=', 'propuestas.id')
            ->where('estado_propuesta.estado_id',2)
            ->WhereYear('propuestas.fecha_last_estado', $año)
            ->whereMonth('propuestas.fecha_last_estado', $mes)
            ->count();
            
        return $propuestas;
    }

}