<?php

namespace App\Http\Controllers;

use App\Http\Requests\createOticRequest;
use Illuminate\Http\Request;
use App\Models\Otic;
class OticController extends Controller
{
    /**
     * Desplegar lista de OTICs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener otics
        $otic = new Otic();
        $otics = $otic->get_otics();

        return view('otic.index')
            ->with(compact('otics'));
    }

    /**
     * Crear una OTIC.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('otic.create');
    }

    /**
     * Guardar una OTIC.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verificar si usuario fue eliminado
        $otic = new Otic();
        $otic = $otic->get_otic_por_rut($request->input('rut'));
        if ($otic != null) {
            //validación mail
            $this->validate($request, [
                'mail' => 'unique:otics,mail,'.$otic->id.'|nullable',
            ]);
            //Almacenar otic
            $otic = new Otic([
                'nombre' => $request->input('nombre'),
                'mail' => $request->input('mail'),
                'telefono_fijo' => $request->input('telefono_fijo'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion'),
                'deleted_at' => null
            ]);
        } else {
            //validación mail
            $this->validate($request, [
                'rut' => 'required|unique:otics,rut',
                'mail' => 'unique:otics,mail|nullable',
            ]);
            //Almacenar otic
            $otic = new Otic([
                'nombre' => $request->input('nombre'),
                'rut' => $request->input('rut'),
                'mail' => $request->input('mail'),
                'telefono_fijo' => $request->input('telefono_fijo'),
                'celular' => $request->input('celular'),
                'direccion' => $request->input('direccion')
            ]);
            $otic->save();
        }
    }

    /**
     * Mostrar datos de una OTIC.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener otic
        $otic = new Otic();
        $otic = $otic->get_otic($id);

        return view('otic.show')
            ->with(compact('otic'));
    }

    /**
     * Editar datos de una OTIC.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener otic
        $otic = new Otic();
        $otic = $otic->get_otic($id);
        return view('otic.edit')
            ->with(compact('otic'));
    }

    /**
     * Actualizar datos de una OTIC.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación mail
        $this->validate($request, [
            'mail' => 'unique:otics,mail,'.$id.'|nullable',
        ]);
        //Obtener otic
        $otic = new Otic();
        $otic = $otic->get_otic($id);

        //Actualizar datos otic
        $otic->update([
            'nombre' => $request->input('nombre'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion')
        ]);
    }

    /**
     * Eliminar una OTIC.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener otic
        $otic = new Otic();
        $otic = $otic->get_otic($id);
        //Borrar contactos
        $otic->del_contactos_otic();
        $otic->delete();
    }
}
