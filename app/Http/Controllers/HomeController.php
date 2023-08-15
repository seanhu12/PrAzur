<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use App\Models\Estado;
use App\Models\Servicio;
use App\Models\Etapa;
use App\Models\EstadoOperacional;
use App\Http\Controllers\Servicios\Comun;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tabla de propuestas
        $propuesta = new Propuesta();
        $propuestas = $propuesta->get_propuestas();

        // Obtener estados
        $estado = new Estado();
        $estados = $estado->get_estados();
        $estadosJson = json_encode($estados);

        // tabla de servicios
        $servicio = new Servicio();
        $servicios = $servicio->get_servicios();

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Obtener etapas
        $etapa = new Etapa();
        $etapas = $etapa->get_etapas();
        $etapasJson = json_encode($etapas);

        // Obtener estados operacionales
        $estadoOperacional = new EstadoOperacional();
        $estadosOperacionales = $estadoOperacional->get_estado_operacional();
        $estadosOperacionalesJson = json_encode($estadosOperacionales);

        // indicadores
        $dias = 30;
        $serviciosProxDias = $servicio->get_indicador_servicios_proximos_dias($dias);
        $serviciosMes = $servicio->get_indicador_servicio_mes();
        $serviciosAtrasados = $servicio->get_indicador_servicio_atrasado();
        $serviciosCierre = $servicio->get_indicador_servicio_cierre();
        $confirmacionesMes = $propuesta->get_indicador_propuesta_confirmadas_mes();
        $propuestasEnviadas = $propuesta->get_indicador_propuesta_enviada_mes();

        // comparadores
        $serviciosMesAnterior = 0;
        $propuestasConfirmadasMesAnterior = 0;
        $propuestasEnviadasMesAnterior = 0;

        // graficos
        // servicios por mes
        $fecha = date("Y-m-d");
        $serviciosMesGrafico = ['servicios'];
        $meses = [];

        $comun = new Comun();

        for ($i = 0; $i < 6; $i++) {
            $mes = date("m", strtotime($fecha));
            $anio =  date("Y", strtotime($fecha));
            $cantServiciosMes = $servicio->get_indicador_servicios_por_mes($anio, $mes);
            array_push($serviciosMesGrafico, $cantServiciosMes);
            array_push($meses, $comun->mesCorto($mes));
            $fecha = date('Y-m-d', strtotime("+1 months", strtotime($fecha)));
        }

        $serviciosMesGrafico = json_encode($serviciosMesGrafico);
        $meses = json_encode($meses);

        // servicios por etapa
        $disenio = $servicio->get_indicador_servicios_por_etapa('Diseño');
        $logistica = $servicio->get_indicador_servicios_por_etapa('Logística');
        $preparado = $servicio->get_indicador_servicios_por_etapa('Preparado');
        $ejecucion = $servicio->get_indicador_servicios_por_etapa('Ejecución');
        $cierre = $servicio->get_indicador_servicios_por_etapa('Cierre');

        $serviciosEtapa = ['servicios',$disenio,$logistica,$preparado,$ejecucion,$cierre];

        $serviciosEtapa = json_encode($serviciosEtapa);

        return view('home')
            ->with(compact('serviciosMesAnterior'))
            ->with(compact('propuestasConfirmadasMesAnterior'))
            ->with(compact('propuestasEnviadasMesAnterior'))
            ->with(compact('serviciosProxDias'))
            ->with(compact('dias'))
            ->with(compact('serviciosMes'))
            ->with(compact('serviciosAtrasados'))
            ->with(compact('serviciosCierre'))
            ->with(compact('confirmacionesMes'))
            ->with(compact('propuestasEnviadas'))
            ->with(compact('propuestas'))
            ->with(compact('estadosJson'))
            ->with(compact('servicios'))
            ->with(compact('fechaActual'))
            ->with(compact('etapasJson'))
            ->with(compact('estadosOperacionalesJson'))
            ->with(compact('serviciosMesGrafico'))
            ->with(compact('meses'))
            ->with(compact('serviciosEtapa'));
    }
}
