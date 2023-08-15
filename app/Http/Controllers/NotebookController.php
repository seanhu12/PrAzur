<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use App\Http\Requests\createNotebookRequest;

class NotebookController extends Controller
{
    /**
     * Desplegar Notebooks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notebook = new Notebook();
        $notebooks = $notebook->get_notebooks();

        return view('notebook.index')
            ->with(compact('notebooks'));
    }

    /**
     * Crear un Notebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notebook.create');
    }

    /**
     * Guardar un Notebook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createNotebookRequest $request)
    {
        //Guardar notebook
        $notebook = new Notebook([
            'codigo' => 'temporal',
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'marca' => $request->input('marca'),
            'hash_file_name' => 'temporal',
            'file_name' => 'temporal',

        ]);
        $notebook->save();
        //Asignar código
        $codigo= "PC".$notebook->id;
        $notebook->update([
            'codigo' => $codigo,
        ]);
        return $notebook->id;
    }

    /**
     * Mostrar datos de un Notebook.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener notebook
        $notebook = new Notebook;
        $notebook = $notebook->get_notebook($id);

        return view('notebook.show')
            ->with(compact('notebook'));
    }

    /**
     * Editar datos de un Notebook.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener notebook
        $notebook = new Notebook;
        $notebook = $notebook->get_notebook($id);
        return view('notebook.edit')
            ->with(compact('notebook'));
    }

    /**
     * Actualizar datos de un Notebook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación
        $this->validate($request, [
            'fecha_adquisicion' => 'required:notebooks,fecha_adquisicion,' . $id,
        ]);
        $this->validate($request, [
            'marca' => 'required:notebooks,marca,' . $id,
        ]);
        //Obtener notebook
        $notebook = new Notebook;
        $notebook = $notebook->get_notebook($id);
        //actualizar notebook
        $notebook->update([
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'marca' => $request->input('marca')

        ]);
        return $notebook->id;
    }

    /**
     * Eliminar un Notebook.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener notebook
        $notebook = new Notebook;
        $notebook = $notebook->get_notebook($id);
        //Borrar foto
        unlink(storage_path().'/app/public/imagenes/fotos_notebooks/'.$notebook->hash_file_name);
        $notebook->delete();
    }

    /**
     * Guardar archivo de la foto de un Notebook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivo(Request $request, $id)
    {
        //Guardar estructura
        $request->file('file')->store('public/imagenes/fotos_notebooks/');
        $hashName=$request->file('file')->hashName();
        $fileName=$request->file('file')->getClientOriginalName();
        //Obtener estructura
        $notebook=new notebook();
        $notebook=$notebook->get_notebook($id);
        $notebook->update([
            'hash_file_name' => $hashName,
            'file_name' => $fileName
        ]);
        return $notebook->id;
    }

    /**
     * Actualizar archivo de la foto de un Notebook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArchivo(Request $request, $id)
    {
        //Obtener estructura
        $notebook=new Notebook();
        $notebook=$notebook->get_notebook($id);
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Borrar antigua foto
            unlink(storage_path().'/app/public/imagenes/fotos_notebooks/'.$notebook->hash_file_name);
            //Guardar nueva estructura
            $request->file('file')->store('public/imagenes/fotos_notebooks/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $notebook->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
        return $notebook->id;
    }

    /**
     * Descargar una foto de un Notebook.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $notebook= new Notebook();
        $notebook=$notebook->get_notebook($id);
        $hashName=$notebook->hash_file_name;
        $nombre=$notebook->file_name;
        $file= storage_path()."/app/public/imagenes/fotos_notebooks/".$hashName;
        return response()->download($file,$nombre);
    }
}
