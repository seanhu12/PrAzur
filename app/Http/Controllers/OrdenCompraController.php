<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Requests\createOrdenCompraRequest;
use App\Models\OrdenCompra;
use App\Models\Propuesta;
use App\Models\Servicio;
use Illuminate\Http\Request;

class OrdenCompraController extends Controller
{
    /**
     * Desplegar lista de Ordenes de compra.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $servicio = new Servicio();
        $servicio =$servicio->get_servicio($id);
        $empresa = new Empresa();
        $empresas =$empresa->get_empresas();
        $empresasJson= json_encode($empresas);
        $ordenesCompra = $servicio->get_ordenes_compra();
        foreach ($ordenesCompra as $orden){
            $orden->nombre_servicio=$servicio->nombre;
            $orden->nombre_empresa=$empresa->get_empresa($orden->empresa_id)->nombre;
        }
        return view('orden_compra.index')
            ->with(compact('servicio'))
            ->with(compact('empresasJson'))
            ->with(compact('ordenesCompra'));
    }

    /**
     * Crear una Orden de Compra.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $servicio = new Servicio();
        $servicio =$servicio->get_servicio($id);

        if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5) {
            $propuesta=$servicio->propuesta();
            $empresaId=$propuesta->empresa_id;
            $empresa = new Empresa();
            $empresas =$empresa->get_empresas();
            $empresasJson= json_encode($empresas);

            return view('orden_compra.create')
                ->with(compact('servicio'))
                ->with(compact('empresaId'))
                ->with(compact('empresasJson'));

        }
    }

    /**
     * Guardar una Orden de Compra
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Almacenar OC
        $ordenCompra = new OrdenCompra([
            'numero' => $request->input('numero'),
            'empresa_id' => $request->input('empresa'),
            'servicio_id' =>$request->input('servicio'),
        ]);
        $ordenCompra->save();
        return $request->input('servicio');
    }

    /**
     * Editar una Orden de Compra.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener empresas
        $empresa = new Empresa();
        $empresas =$empresa->get_empresas();
        $empresasJson= json_encode($empresas);

        //Obtener Orden de compra
        $ordenCompra = new OrdenCompra();
        $ordenCompra = $ordenCompra->get_orden($id);

        //Obtener servicio
        $servicio = new Servicio();
        $servicio=$servicio->get_servicio($ordenCompra->servicio_id);

        if ($servicio->get_last_etapa()->id != 6 && $servicio->get_last_estado_operacional()->id != 5) {
            //Obtener id empresa
            $empresaId= $ordenCompra->empresa_id;
            return view('orden_compra.edit')
                ->with(compact('servicio'))
                ->with(compact('empresasJson'))
                ->with(compact('empresaId'))
                ->with(compact('ordenCompra'));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Obtener orden de compra
        $ordenCompra = new OrdenCompra();
        $ordenCompra = $ordenCompra->get_orden($id);

        //Actualizar datos orden de compra
        $ordenCompra->update([
            'numero' => $request->input('numero'),
            'empresa_id' => $request->input('empresa'),
            'servicio_id' => $request->input('servicio')
        ]);
        return $request->input('servicio');
    }

    /**
     * Eliminar una Orden de Compra.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $ordenCompra = new OrdenCompra();
        $ordenCompra = $ordenCompra->get_orden($id);
        $ordenCompra->delete();
        return $ordenCompra->servicio_id;
    }
}
