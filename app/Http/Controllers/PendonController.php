<?php

namespace App\Http\Controllers;

use App\Http\Requests\createPendonRequest;
use App\Models\Pendon;
use App\Models\Tematica;
use Illuminate\Http\Request;

class PendonController extends Controller
{
    /**
     * Desplegar Lista de Pendones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendon = new Pendon();
        $pendones = $pendon->get_pendones();
        $tematica = new Tematica;
        $tematicas = $tematica->get_tematicas();
        $tematicasJson = json_encode($tematicas);

        return view('pendon.index')
            ->with(compact('tematicasJson'))
            ->with(compact('pendones'));
    }

    /**
     * Crear un Pendon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tematica = new Tematica;
        $tematicas = $tematica->get_tematicas();
        $tematicasJson = json_encode($tematicas);
        return view('pendon.create')
            ->with(compact('tematicasJson'));
    }

    /**
     * Guardar un Pendon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Almacenar pendon
        $pendon = new Pendon([
            'codigo' => 'temporal',
            'nombre' => $request->input('nombre'),
            'hash_file_name' => 'temporal',
            'file_name' => 'temporal',
        ]);
        $pendon->save();
        //Asignar código
        $codigo= "PE".$pendon->id;
        $pendon->update([
            'codigo' => $codigo,
        ]);
        //Asignar tematicas
        $tematicas = $request->input('tematicas');
        $pendon->set_tematicas($tematicas);
        return $pendon->id;
    }

    /**
     * Mostrar datos de un Pendon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendon = new Pendon;
        $pendon = $pendon->get_pendon($id);
        $tematicasPendon = $pendon->tematicas();
        return view('pendon.show')
            ->with(compact('pendon'))
            ->with(compact('tematicasPendon'));
    }

    /**
     * Editar datos de un Pendon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener tematicas
        $tematica = new Tematica();
        $tematicas = $tematica->get_tematicas();
        $tematicasJson = json_encode($tematicas);

        //Obtener pendon
        $pendon = new Pendon();
        $pendon = $pendon->get_pendon($id);
        $tematicapendons = $pendon->get_id_tematicas();
        $tematicasPendonArray = json_encode($tematicapendons);

        return view('pendon.edit')
            ->with(compact('tematicasPendonArray'))
            ->with(compact('tematicasJson'))
            ->with(compact('pendon'));
    }

    /**
     * Actualizar datos de un Pendon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre
        // $this->validate($request, [
        //     'nombre' => 'required|unique:pendons,nombre,' . $id,
        // ]);

        //Obtener pendon
        $pendon = new Pendon();
        $pendon = $pendon->get_pendon($id);

        //Actulizar datos del pendon
        $pendon->update([
            'nombre' => $request->input('nombre')
        ]);

        //Asignar nuevas tematicas
        $tematicas = $request->input('tematicas');
        $pendon->set_tematicas($tematicas);
        return $pendon->id;
    }

    /**
     * Eliminar un Pendon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $pendon = new Pendon();
        $pendon = $pendon->get_pendon($id);
        //eliminar tematicas
        $pendon->del_tematicas();
        //Borrar foto
        unlink(storage_path().'/app/public/imagenes/fotos_pendones/'.$pendon->hash_file_name);
        $pendon->delete();
    }

    /**
     * Guardar archivo de la foto de un Pendon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivo(Request $request, $id)
    {
        //Guardar estructura
        $request->file('file')->store('public/imagenes/fotos_pendones/');
        $hashName=$request->file('file')->hashName();
        $fileName=$request->file('file')->getClientOriginalName();
        //Obtener estructura
        $pendon=new Pendon();
        $pendon=$pendon->get_pendon($id);
        $pendon->update([
            'hash_file_name' => $hashName,
            'file_name' => $fileName
        ]);
        return $pendon->id;
    }


    /**
     * Actualizar archivo de la foto de un Pendon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArchivo(Request $request, $id)
    {
        //Obtener estructura
        $pendon=new Pendon();
        $pendon=$pendon->get_pendon($id);
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Borrar antigua foto
            unlink(storage_path().'/app/public/imagenes/fotos_pendones/'.$pendon->hash_file_name);
            //Guardar nueva estructura
            $request->file('file')->store('public/imagenes/fotos_pendones/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $pendon->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
        return $pendon->id;
    }



    /**
     * Descargar una foto de un Pendon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $pendon= new Pendon();
        $pendon=$pendon->get_pendon($id);
        $hashName=$pendon->hash_file_name;
        $nombre=$pendon->file_name;
        $file= storage_path()."/app/public/imagenes/fotos_pendones/".$hashName;
        return response()->download($file,$nombre);
    }
}
