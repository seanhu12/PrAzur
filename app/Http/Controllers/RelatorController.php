<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\DocumentoRelator;
use App\Http\Requests\createRelatorRequest;
use App\Models\Relator;
use Illuminate\Http\Request;

class RelatorController extends Controller
{
    /**
     * Desplegar Relatores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener todos los relators
        $relator = new Relator();
        $relatores = $relator->get_relatores();
        $ciudades = Array();
        foreach ($relatores as $relator){
            array_push($ciudades,$relator->ciudad());
        }

        return view('relator.index')
            ->with(compact('relatores'))
            ->with(compact('ciudades'));
    }

    /**
     * Crear un Relator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        return view('relator.create')
            ->with(compact('ciudadesJson'));
    }

    /**
     * Guardar un Relator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verificar si usario fue eliminado
        $relator = new Relator();
        $relator = $relator->get_relator_por_rut($request->input('rut'));
        if ($relator != null) {
            //validación mail
            $this->validate($request, [
                'mail' => 'unique:relators,mail,' . $relator->id.'|nullable',
            ]);
            //Almacenar relator
            $relator->update([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'rut' => $request->input('rut'),
                'mail' => $request->input('mail'),
                'celular' => $request->input('celular'),
                'vigencia_sence' => $request->input('vigencia_sence'),
                'ciudad_id' => $request->input('ciudad'),
                'deleted_at' => null
            ]);
        } else {
            //validación mail
            $this->validate($request, [
                'rut' => 'required|unique:relators,rut',
                'mail' => 'unique:relators,mail|nullable',
            ]);
            //Almacenar relator
            $relator = new Relator([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'rut' => $request->input('rut'),
                'mail' => $request->input('mail'),
                'celular' => $request->input('celular'),
                'vigencia_sence' => $request->input('vigencia_sence'),
                'ciudad_id' => $request->input('ciudad')
            ]);
            $relator->save();
        }
        return $relator->id;
    }

    /**
     * Mostrar datos de un Relator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener relator
        $relator = new Relator;
        $relator = $relator->get_relator($id);
        $ciudad= $relator->ciudad();

        return view('relator.show')
            ->with(compact('relator'))
            ->with(compact('ciudad'));
    }

    /**
     * Editar datos de un Relator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener ciudades
        $ciudad = new Ciudad;
        $ciudades = $ciudad->get_ciudades();
        $ciudadesJson = json_encode($ciudades);

        //Obtener relator
        $relator = new Relator;
        $relator = $relator->get_relator($id);

        //Obtener ciudad
        $ciudad=$relator->ciudad();
        $ciudadId= $ciudad->id;
        return view('relator.edit')
            ->with(compact('ciudadesJson'))
            ->with(compact('ciudadId'))
            ->with(compact('relator'));
    }

    /**
     * Actualizar datos de un Relator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación mail
        $this->validate($request, [
            'mail' => 'unique:relators,mail,' . $id.'nullable',
        ]);
        //Obtener relator
        $relator = new Relator;
        $relator = $relator->get_relator($id);

        //Actualizar datos relator
        $relator->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail'),
            'celular' => $request->input('celular'),
            'vigencia_sence' => $request->input('vigencia_sence'),
            'ciudad_id' => $request->input('ciudad')
        ]);
        return $id;
    }

    /**
     * Eliminar un Relator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener relator
        $relator = new Relator;
        $relator = $relator->get_relator($id);
        $relator->del_documentos();
        $relator->delete();
    }


    /**
     * Guarda los archivos de un Relator.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardarArchivos(Request $request, $id)
    {
        // Guardar archivo
        if ($request->hasfile('files')) {

            foreach ($request->file('files') as $file) {
                $file->store('public/documentos/certificados_relatores/');
                $nombre = $file->getClientOriginalName();
                $hashName = $file->hashName();

                $documentoRelator = new DocumentoRelator([
                    'file_name' => $nombre,
                    'hash_file_name' => $hashName,
                    'relator_id' => $id,

                ]);
                $documentoRelator->save();
            }
        }
        return $id;
    }

    /**
     * Descargar un archivo de un Relator
     *
     * @param int $hash_file_name
     * @return \Illuminate\Http\Response
     */
    public function descargarArchivo($hash_file_name, $file_name)
    {
        return response()->download(storage_path().'/app/public/documentos/certificados_relatores/'.$hash_file_name, $file_name);
    }

    /**
     * Eliminar un archivo de un Relator
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function eliminarArchivo(Request $request)
    {
        $documentoRelator = new DocumentoRelator();
        $documentoRelator = $documentoRelator->get_documento($request->input('idArchivo'));

        //eliminar documento del storage
        unlink(storage_path().'/app/public/documentos/certificados_relatores/'.$documentoRelator->hash_file_name);

        //eliminar documento de la base de datos
        $documentoRelator->delete();
    }
}
