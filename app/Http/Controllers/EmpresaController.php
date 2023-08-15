<?php

namespace App\Http\Controllers;

use App\Http\Requests\createEmpresaRequest;
use App\Http\Requests\createMetasVentaRequest;
use App\Models\MetasVenta;
use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /**
     * Desplegar Empresas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = new Empresa();
        $empresas = $empresa->get_empresas();

        return view('empresa.index')
            ->with(compact('empresas'));
    }

    /**
     * Desplegar Metas Venta de una empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMeta($id)
    {
        $empresa = Empresa::find($id);
        $metas = $empresa->metas_venta; // La consulta se ejecuta automáticamente aquí
        $metasJson = json_encode($metas);
    
        return view('empresa.metas_venta.index', compact('metas', 'metasJson', 'empresa'));
    }
    



    /**
     * Crear una Empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        $empresa = new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        return view('empresa.create')
            ->with(compact('empresasJson'))
            ->with(compact('ciudadesJson'));
    }

    /**
     * Crear una Meta Venta de una Empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMeta($id)
    {
        //Obtener empresa
        $empresa = new empresa;
        $empresa = $empresa->get_empresa($id);

        return view('empresa.metas_venta.create')
            ->with(compact('empresa'));
    }

    /**
     * Guardar una Empresa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verificar si empresa fue eliminada
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa_por_rut($request->input('rut'));
        if ($empresa != null) {
            //validación empresa
            $this->validate($request, [
                'rut' => 'required',
                'mail' => 'unique:empresas,mail,'.$empresa->id.'|nullable',
            ]);
            //Almacenar empresa
            $empresa->update([
                'nombre' => $request->input('nombre'),
                'mail' => $request->input('mail'),
                'telefono_fijo' => $request->input('telefono_fijo'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion'),
                'ciudad_id' => $request->input('ciudad'),
                'holding_id' => $request->input('holding'),
                'deleted_at' => null
            ]);
        } else {
            //validación empresa
            $this->validate($request, [
                'rut' => 'required|unique:empresas,rut',
                'mail' => 'unique:empresas,mail|nullable',
            ]);
            //Almacenar empresa
            $empresa = new Empresa([
                'nombre' => $request->input('nombre'),
                'rut' => $request->input('rut'),
                'mail' => $request->input('mail'),
                'telefono_fijo' => $request->input('telefono_fijo'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion'),
                'ciudad_id' => $request->input('ciudad'),
                'holding_id' => $request->input('holding')
            ]);
            //Crear metas de la empresa
            $empresa->save();
            for ($i=1;$i<=12;$i++){
                $meta = new MetasVenta([
                    'anio' => date("Y", time()),
                    'mes' => $i,
                    'fecha_reporte' =>date("Y", time()).'-'.$i.'-'.'1',
                    'monto_meta' => 0,
                    'empresa_id'=> $empresa->id
                ]);
                $meta->save();
            }
        }
    }

    /**
     * Guardar una Meta Venta de una Empresa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeMeta(createMetasVentaRequest $request, $id)
    {
        //Almacenar Meta Venta
        $meta = new MetasVenta([
            'anio' => $request->input('anio'),
            'mes' => $request->input('mes'),
            'fecha_reporte' =>$request->input('anio').'-'.$request->input('mes').'-'.'1',
            'monto_meta' => $request->input('monto_meta'),
            'empresa_id'=> $id
        ]);
        $meta->save();
    }

    /**
     * Mostrar Datos empresa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener empresa
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($id);
        $ciudad= $empresa->get_ciudad();
        if($ciudad==null){
            $ciudad= new Ciudad();
            $ciudad->nombre="";
        }
        if($empresa->direccion==null){
            $empresa->direccion="";
        }
        if($empresa->celular==null){
            $empresa->celular="";
        }
        if($empresa->telefono_fijo==null){
            $empresa->telefono_fijo="";
        }
        $holding=$empresa->get_empresa($empresa->holding_id);
        if($holding!=null){
            $empresa->nombre_holding=$holding->nombre;
        }else{
            $empresa->nombre_holding="";
        }


        return view('empresa.show')
            ->with(compact('empresa'))
            ->with(compact('ciudad'));

    }

    /**
     * Mostrar Datos de las metas de una Empresa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showMeta($id)
    {
        //Obtener empresa
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($id);

        return view('empresa.metas_venta.show')
            ->with(compact('empresa'));

    }

    /**
     * Editar datos de una Empresa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener ciudades
        $ciudad = new Ciudad();
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);


        //Obtener empresa
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($id);

        //Obtner empresas
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        //Obtener ciudad
        $ciudad=$empresa->get_ciudad();
        if($ciudad==null){
            $ciudadId="";
        }else{
            $ciudadId= $ciudad->id;
        }

        return view('empresa.edit')
            ->with(compact('ciudadesJson'))
            ->with(compact('empresasJson'))
            ->with(compact('ciudadId'))
            ->with(compact('empresa'));

    }

    /**
     * Editar datos de una Meta Venta de una Empresa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editMeta($id)
    {
        //Obtener Meta
        $metaVenta = new MetasVenta;
        $metaVenta = $metaVenta->get_meta($id);

        //Obtener empresa
        $empresa=$metaVenta->empresa();
        return view('empresa.metas_venta.edit')
            ->with(compact('metaVenta'))
            ->with(compact('empresa'));

    }

    /**
     * Actualizar los datos de una Empresa.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación mail
        $this->validate($request, [
            'mail' => 'unique:empresas,mail,'.$id.'|nullable',
        ]);
        //Obtener empresa
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($id);

        //Actualizar datos empresa
        $empresa->update([
            'nombre' => $request->input('nombre'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'ciudad_id' => $request->input('ciudad'),
            'holding_id' => $request->input('holding')
        ]);

    }

    /**
     * Actualizar los datos de una Meta Venta de una Empresa.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateMeta(Request $request, $id)
    {
        //Obtener Meta Venta
        $meta = new MetasVenta();
        $meta = $meta->get_meta($id);

        //Actualizar datos meta venta
        $meta->update([
            'monto_meta' => $request->input('monto_meta')
        ]);

        return $meta->empresa_id;
    }

    /**
     * Eliminar una Empresa
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa($id);
        //borrar contactos
        $empresa->del_contactos_empresa();
        $empresa->delete();
    }

    /**
     * Eliminar Meta Venta de una Empresa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMeta(Request $request)
    {
        $id=$request->input('id');
        $metaVenta = new MetasVenta;
        $metaVenta = $metaVenta->get_meta($id);
        $metaVenta->delete();
    }
}
