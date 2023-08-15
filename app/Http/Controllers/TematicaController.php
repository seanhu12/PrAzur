<?php

namespace App\Http\Controllers;

use App\Http\Requests\createTematicaRequest;
use App\Models\Tematica;
use Illuminate\Http\Request;

class TematicaController extends Controller
{
    /**
     * Desplegar lista de Tematicas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tematica = new Tematica();
        $tematicas = $tematica->get_tematicas();

        return view('tematica.index')
            ->with(compact('tematicas'));
    }

    /**
     * Crear una Tematica.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tematica.create');
    }

    /**
     * Guardar una Tematica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verificar si la tematica fue eliminada
        $tematica = new Tematica();
        $tematica = $tematica->get_tematica_por_nombre($request->input('nombre'));
        if ($tematica != null) {
            //validación nombre
            $this->validate($request, [
                'nombre' => 'required|unique:tematicas,nombre,' . $tematica->id,
            ]);
            //Guardar temática
            $tematica->update([
                'deleted_at' => null
            ]);
        } else {
            //validación nombre
            $this->validate($request, [
                'nombre' => 'required|unique:tematicas,nombre',
            ]);
            //Guardar temática
            $tematica = new Tematica([
                'nombre' => $request->input('nombre')
            ]);
            $tematica->save();
        }
    }

    /**
     * Mostrar datos de una Tematica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener temática
        $tematica = new Tematica();
        $tematica = $tematica->get_tematica($id);

        return view('tematica.show')
            ->with(compact('tematica'));
    }

    /**
     * Editar datos de una Tematica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener temática
        $tematica = new Tematica();
        $tematica = $tematica->get_tematica($id);

        return view('tematica.edit')
            ->with(compact('tematica'));
    }

    /**
     * Actualizar datos de una Tematica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre
        $this->validate($request, [
            'nombre' => 'required|unique:tematicas,nombre,' . $id,
        ]);
        //Actualizar temática
        $tematica = new Tematica();
        $tematica = $tematica->get_tematica($id);

        $tematica->update([
            'nombre' => $request->input('nombre')
        ]);
    }

    /**
     * Eliminar una Tematica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener temática
        $tematica = new Tematica();
        $tematica = $tematica->get_tematica($id);
        //Soft-delete
        $tematica->delete();
    }
}
