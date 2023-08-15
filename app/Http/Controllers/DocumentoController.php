<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Http\Requests\createDocumentoRequest;
use App\Models\Tematica;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Desplear lista de Documentos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener documentos
        $documento = new Documento;
        $documentos = $documento->get_documentos();
        //Obtener tipos
        $tipo= new TipoDocumento;
        $tipos = $tipo->get_tipos_documentos();
        $tiposJson = json_encode($tipos);
        //Obtener tipos y tematicas por documento
        $tipos = Array();
        $tematicas= Array();
        foreach ($documentos as $documento){
            array_push($tipos,$documento->tipo_documento());
            array_push($tematicas,$documento->tematica());
        }
        return view('documento.index')
            ->with(compact('documentos'))
            ->with(compact('tematicas'))
            ->with(compact('tiposJson'))
            ->with(compact('tipos'));
    }

    /**
     * Crear un Documento.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener tipos
        $tipo= new TipoDocumento;
        $tipos = $tipo->get_tipos_documentos();
        $tiposJson = json_encode($tipos);
        //Obtener tematicas
        $tematica= new Tematica;
        $tematicas = $tematica->get_tematicas();
        $tematicasJson = json_encode($tematicas);

        return view('documento.create')
            ->with(compact('tiposJson'))
            ->with(compact('tematicasJson'));
    }

    /**
     * Guardar un documento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createDocumentoRequest $request)
    {
        //Almacenar documento
        $documento = new Documento([
            'nombre' => $request->input('nombre'),
            'codigo' => 'temporal',
            'tipo_documento_id' => $request->input('tipo'),
            'tematica_id' => $request->input('tematica'),
            'hash_file_name' => 'temporal',
            'file_name' => 'temporal'
        ]);
        $documento->save();
        //Asignar código
        $codigo= "DOC".$documento->id;
        $documento->update([
            'codigo' => $codigo,
        ]);
        return $documento->id;
    }

    /**
     * Guardar archivo de un Documento en la carpeta estructura_documentos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivo(Request $request, $id)
    {
        //Obtener docuemnto
        $documento=new Documento;
        $documento=$documento->get_documento($id);
        //Obtener tipo
        $tipo=$documento->tipo_documento();
        $nombreTipo=$tipo->nombre_snake;
        //Guardar estructura
        $request->file('file')->store('public/documentos/documentos_servicio/'.$nombreTipo.'/');
        $hashName=$request->file('file')->hashName();
        $fileName=$request->file('file')->getClientOriginalName();
        $documento->update([
            'hash_file_name' => $hashName,
            'file_name' => $fileName
        ]);


    }

    /**
     * Actualizar archivo de estructura de un documento en la carpeta documentos servicios, dentro de la carpeta tipo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArchivo(Request $request, $id)
    {
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Obtener documento
            $documento=new Documento;
            $documento=$documento->get_documento($id);
            //Obtener tipo
            $tipo=$documento->tipo_documento();
            $nombreTipo=$tipo->nombre_snake;
            //Borrar antiguo archivo
            unlink(storage_path().'/app/public/documentos/documentos_servicio/'.$nombreTipo.'/'.$documento->hash_file_name);
            //Guardar nueva estructura
            $request->file('file')->store('public/documentos/documentos_servicio/'.$nombreTipo.'/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $documento->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
    }

    /**
     * Mostrar datos de un documento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener documento
        $documento = new Documento();
        $documento = $documento->get_documento($id);
        //Obtener tipo
        $tipo= $documento->tipo_documento();
        //Obtener tematica
        $tematica= $documento->tematica();
        return view('documento.show')
            ->with(compact('documento'))
            ->with(compact('tipo'))
            ->with(compact('tematica'));
    }

    /**
     * Descargar el archivo de un documento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $documento= new Documento;
        $documento=$documento->get_documento($id);
        $hashName=$documento->hash_file_name;
        $nombre=$documento->file_name;
        //Obtener tipo
        $tipo=$documento->tipo_documento();
        $nombreTipo=$tipo->nombre_snake;
        $file= storage_path()."/app/public/documentos/documentos_servicio/".$nombreTipo."/".$hashName;
        return response()->download($file,$nombre);
    }

    /**
     * Editar datos de un Documento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener temáticas
        $tematica = new Tematica;
        $tematicas = $tematica->get_tematicas();
        $tematicasJson = json_encode($tematicas);

        //Obtener documento
        $documento= new Documento;
        $documento= $documento->get_documento($id);

        //Obtener tipo
        $tipo=$documento->tipo_documento();

        //Obtener temática
        $tematica=$documento->tematica();
        $tematicaId=$tematica->id;

        return view('documento.edit')->with(compact('tematicasJson'))
            ->with(compact('tipo'))
            ->with(compact('documento'))
            ->with(compact('tematicaId'));
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
        //Obtener documento
        $documento= new Documento;
        $documento= $documento->get_documento($id);
        //Almacenar documento
        $documento->update([
            'nombre' => $request->input('nombre'),
            'tematica_id' => $request->input('tematica')
        ]);
        $documento->save();
        return $documento->id;
    }

    /**
     * Eliminar un Documento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $documento = new Documento;
        $documento->del_documento($id);
    }
}
