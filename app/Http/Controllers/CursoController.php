<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\CursoEstructura;
use App\Models\Estructura;
use App\Http\Requests\createCursoRequest;
use App\Http\Requests\createEstructuraRequest;
use Illuminate\Http\Request;
use App\Models\Tematica;

class CursoController extends Controller
{
    /**
     * Desplegar lista de Cursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = new Curso();
        $cursos = $curso->get_cursos();
        $tematicas = Array();
        $codigosSence= Array();
        foreach ($cursos as $curso){
            array_push($tematicas,$curso->tematica());
            //Obtener códigos SENCE
            if($curso->codigo_sence==null){
                array_push($codigosSence,'No tiene');
            }else{
                array_push($codigosSence,$curso->codigo_sence);
            }
        }
        return view('curso.index')
            ->with(compact('tematicas'))
            ->with(compact('codigosSence'))
            ->with(compact('cursos'));
    }

    /**
     * Desplear lista de Estructuras de un Curso.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEstructura($id)
    {
        //Obtener estructuras
        $curso= new Curso;
        $curso=$curso->get_curso($id);
        $estructuras = $curso->estructuras();
        return view('estructura.index')
            ->with(compact('estructuras'))
            ->with(compact('curso'));
    }

    /**
     * Crear un Curso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tematica = new Tematica;

        $tematicas = $tematica->get_tematicas();

        $tematicasJson = json_encode($tematicas);

        return view('curso.create')->with(compact('tematicasJson'));
    }

    /**
     * Crear una estructura para un Curso.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEstructura($id)
    {
        //Obtener curso
        $curso = new Curso;
        $curso = $curso->get_curso($id);
        return view('estructura.create')->with(compact('curso'));
    }

    /**
     * Guardar un Curso.
     *
     * @param  \Illuminate\Http\createCursoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createCursoRequest $request)
    {
        //Almacenar curso
        $curso = new Curso([
            'nombre_venta' => $request->input('nombre_venta'),
            'codigo' => 'temporal',
            'anio_creacion' => $request->input('anio_creacion'),
            'cant_horas' => $request->input('cant_horas'),
            'cant_horas_practicas' => $request->input('cant_horas_practicas'),
            'cant_horas_teoricas' => $request->input('cant_horas_teoricas'),
            'cant_participantes' => $request->input('cant_participantes'),
            'descripcion' => $request->input('descripcion'),
            'tematica_id' => $request->input('tematica'),
            'hash_file_name_programa' => 'temporal',
            'file_name_programa' => 'temporal',
            'nombre_sence' => $request->input('nombre_sence'),
            'codigo_sence' => $request->input('codigo_sence'),
            'vigencia' => $request->input('vigencia'),
        ]);
        $curso->save();
        //Asignar código
        $codigo= "CUR".$curso->id;
        $curso->update([
            'codigo' => $codigo,
        ]);
        return $curso->id;

    }

    /**
     * Guardar un documento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEstructura(createEstructuraRequest $request,$id)
    {
        //Almacenar estructura
        $estructura = new Estructura([
            'nombre' => $request->input('nombre'),
            'codigo' => 'temporal',
            'hash_file_name' => 'temporal',
            'file_name' => 'temporal',
            'curso_id' => $id
        ]);
        $estructura->save();
        //Asignar código
        $codigo= "EST".$estructura->id;
        $estructura->update([
            'codigo' => $codigo,
        ]);
        return $estructura->id;
    }

    /**
     * Guardar archivo de estructura de un Curso en la carpeta estructura_cursos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeArchivo(Request $request, $id)
    {
        //Guardar estructura
        $request->file('file')->store('public/documentos/estructura_cursos/');
        $hashName=$request->file('file')->hashName();
        $fileName=$request->file('file')->getClientOriginalName();
        //Obtener estructura
        $estructura=new Estructura;
        $estructura=$estructura->get_estructura($id);
        $estructura->update([
            'hash_file_name' => $hashName,
            'file_name' => $fileName
        ]);
        $curso=$estructura->curso();
         return $curso->id;
    }

    /**
     * Actualizar archivo de una estructura de un Curso en la carpeta estructura_cursos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArchivo(Request $request, $id)
    {
        //Obtener estructura
        $estructura=new Estructura;
        $estructura=$estructura->get_estructura($id);
        //Comprobar si se debe actualizar
        if($request->file('file')!=null){
            //Borrar antigua estructura
            unlink(storage_path().'/app/public/documentos/estructura_cursos/'.$estructura->hash_file_name);
            //Guardar nueva estructura
            $request->file('file')->store('public/documentos/estructura_cursos/');
            $hashName=$request->file('file')->hashName();
            $fileName=$request->file('file')->getClientOriginalName();
            $estructura->update([
                'hash_file_name' => $hashName,
                'file_name' => $fileName
            ]);
        }
        $curso=$estructura->curso();
        return $curso->id;
    }


    /**
     * Mostrar datos de un Curso.
     *
     * @param  int  $id
     * @return Vista con los datos
     */
    public function show($id)
    {
        //Obtener curso
        $curso = new Curso;
        $curso = $curso->get_curso($id);
        $tematica= $curso->tematica();
        //Obtener datos sence
        $sence=true;
        //verificar si tiene datos
        if($curso->codigo_sence==null){
            $sence=false;
        }
        return view('curso.show')
            ->with(compact('curso'))
            ->with(compact('sence'))
            ->with(compact('tematica'));
    }

    /**
     * Descargar una estructura de un Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $estructura= new Estructura;
        $estructura=$estructura->get_estructura($id);
        $hashName=$estructura->hash_file_name;
        $nombre=$estructura->file_name;
        $file= storage_path()."/app/public/documentos/estructura_cursos/".$hashName;
        return response()->download($file,$nombre);
    }

    /**
     * Editar datos de un Curso.
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

        //Obtener curso
        $curso= new Curso;
        $curso= $curso->get_curso($id);

        //Obtener temática
        $tematica=$curso->tematica();
        $tematicaId=$tematica->id;


        return view('curso.edit')->with(compact('tematicasJson'))
            ->with(compact('curso'))
            ->with(compact('tematicaId'));
    }


    /**
     * Editar datos de un Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEstructura($id)
    {
        //Obtener estructura
        $estructura = new Estructura;
        $estructura = $estructura->get_estructura($id);
        $curso = new Curso();
        $curso=$curso->get_curso($estructura->curso_id);

        return view('estructura.edit')->with(compact('curso'))->with(compact('estructura'));
    }

    /**
     * Actualizar datos de un Curso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEstructura(Request $request, $id)
    {
        //validación nombre venta
        $this->validate($request, [
            'nombre' => 'required:estructuras,nombre,' . $id,
        ]);
        //Obtener estructura
        $estructura = new Estructura;
        $estructura = $estructura->get_estructura($id);
        //Almacenar estructura
        $estructura->update([
            'nombre' => $request->input('nombre'),
        ]);
        return $estructura->id;

    }

    /**
     * Actualizar datos de un Curso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre venta
        $this->validate($request, [
            'nombre_venta' => 'required|unique:cursos,nombre_venta,' . $id,
        ]);
        //Obtener curso
        $curso = new Curso();
        $curso = $curso->get_curso($id);
        //Almacenar curso
        $curso->update([
            'nombre_venta' => $request->input('nombre_venta'),
            'anio_creacion' => $request->input('anio_creacion'),
            'cant_horas' => $request->input('cant_horas'),
            'cant_horas_practicas' => $request->input('cant_horas_practicas'),
            'cant_horas_teoricas' => $request->input('cant_horas_teoricas'),
            'cant_participantes' => $request->input('cant_participantes'),
            'descripcion' => $request->input('descripcion'),
            'tematica_id' => $request->input('tematica'),
            'nombre_sence' => $request->input('nombre_sence'),
            'codigo_sence' => $request->input('codigo_sence'),
            'vigencia' => $request->input('vigencia'),
        ]);
        return $curso->id;

    }

    /**
     * Eliminar un Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $curso = new Curso();
        $curso = $curso->get_curso($id);
        $curso->del_estructuras();

        $curso->delete();
    }

    /**
     * Eliminar una estructura de un Curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEstructura(Request $request)
    {
        $id=$request->input('id');
        $estructura = new Estructura();
        $estructura = $estructura->get_estructura($id);
        $idCurso=$estructura->curso_id;
        //Borrar  estructura
        //unlink(storage_path().'/app/public/documentos/estructura_cursos/'.$estructura->hash_file_name);
        $estructura->delete();
        return $idCurso;
    }
}
