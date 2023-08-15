<?php

namespace App\Http\Controllers;

use App\Models\Proyector;
use Illuminate\Http\Request;
use App\Http\Requests\createProyectorRequest;

class ProyectorController extends Controller
{
    /**
     * Desplegar Proyectores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyector = new Proyector();
        $proyectors = $proyector->get_proyectors();

        return view('proyector.index')
            ->with(compact('proyectors'));
    }

    /**
     * Crear un Proyector.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyector.create');
    }

    /**
     * Guardar un Proyector.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createProyectorRequest $request)
    {
        //Guardar proyector
        $proyector = new Proyector([
            'codigo' => 'temporal',
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'hash_file_name' => 'temporal',
            'file_name' => 'temporal',
        ]);
        $proyector->save();
        //Asignar código
        $codigo= "PRO".$proyector->id;
        $proyector->update([
            'codigo' => $codigo,
        ]);
        return $proyector->id;
    }


    /**
     * Editar datos de un Proyector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener proyector
        $proyector = new Proyector;
        $proyector = $proyector->get_proyector($id);
        return view('proyector.edit')
            ->with(compact('proyector'));
    }

    /**
     * Actualizar datos de un Proyector.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación
        $this->validate($request, [
            'fecha_adquisicion' => 'required:proyectors,fecha_adquisicion,' . $id,
        ]);
        //Obtener proyector
        $proyector = new Proyector;
        $proyector = $proyector->get_proyector($id);
        //actualizar proyector
        $proyector->update([
            'fecha_adquisicion' => $request->input('fecha_adquisicion')

        ]);
        return $proyector->id;
    }

    /**
     * Eliminar un Proyector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener proyector
        $proyector = new Proyector;
        $proyector = $proyector->get_proyector($id);
        //Borrar foto
        unlink(storage_path().'/app/public/imagenes/fotos_proyectores/'.$proyector->hash_file_name);
        $proyector->delete();
    }

    /**
     * Guardar archivo de la foto de un proyector.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivo(Request $request, $id)
    {
        //Guardar estructura
        $request->file('file')->store('public/imagenes/fotos_proyectores/');
        $hashName=$request->file('file')->hashName();
        $fileName=$request->file('file')->getClientOriginalName();
        //Obtener estructura
        $proyector=new proyector();
        $proyector=$proyector->get_proyector($id);
        $proyector->update([
            'hash_file_name' => $hashName,
            'file_name' => $fileName
        ]);
        return $proyector->id;
    }


    /**
     * Actualizar archivo de la foto de un Proyector.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArchivo(Request $request, $id)
    {
        //Obtener estructura
        $proyector=new Proyector();
        $proyector=$proyector->get_proyector($id);
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Borrar antigua foto
            unlink(storage_path().'/app/public/imagenes/fotos_proyectores/'.$proyector->hash_file_name);
            //Guardar nueva estructura
            $request->file('file')->store('public/imagenes/fotos_proyectores/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $proyector->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
        return $proyector->id;
    }



    /**
     * Descargar una foto de un proyector.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $proyector= new Proyector();
        $proyector=$proyector->get_proyector($id);
        $hashName=$proyector->hash_file_name;
        $nombre=$proyector->file_name;
        $file= storage_path()."/app/public/imagenes/fotos_proyectores/".$hashName;
        return response()->download($file,$nombre);
    }
}
