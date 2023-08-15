<?php

namespace App\Http\Controllers;


use App\Models\Parametro;
use App\Models\Etapa;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    /**
     * Editar parámetros de un Servicio.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function editParametros(){
        $etapa= new Etapa();
        $etapas= $etapa->get_etapas();
        $etapasJson=json_encode($etapas);
        $parametro= new Parametro();
        $parametros=$parametro->get_parametros();
        $parametrosJson=json_encode($parametros);
        return view('parametro.edit_parametros')
            ->with(compact('etapasJson'))
            ->with(compact('parametrosJson'))
            ->with(compact('etapas'))
            ->with(compact('parametros'));
    }

    /**
     * Actualizar parámetros de un Servicio.
     *
     ** @param \Illuminate\Http\Request $request
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function updateParametros(Request $request){
        $etapas= $request->input('etapas');
        foreach ($etapas as $etapa){
            $variable= new Etapa();
            $variable=$variable->get_etapa($etapa["id"]);
            $variable->tiempo_limite=$etapa["tiempo_limite"];
            $variable->save();
        }
        $parametros=$request->input('parametros');
        foreach ($parametros as $parametro){
            $variable= new Parametro();
            $variable=$variable->get_parametro($parametro["id"]);
            $variable->tiempo_limite=$parametro["tiempo_limite"];
            $variable->save();
        }
    }
}
