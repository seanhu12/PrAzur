<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\createProgramaRequest;
use App\Models\Curso;
use App\Models\Programa;

class ProgramaController extends Controller
{
    /**
     * Desplegar Lista de Programas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programa = new Programa();
        $programas = $programa->get_programas();

        return view('programa.index')
            ->with(compact('programas'));
    }

    /**
     * Crear un Programa.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curso = new Curso();
        $cursos = $curso->get_cursos();
        $cursosJson = json_encode($cursos);
        return view('programa.create')
            ->with(compact('cursosJson'));
    }

    /**
     * Guardar un Programa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(createProgramaRequest $request)
    {
        //Almacenar programa
        $programa = new Programa([
            'nombre' => $request->input('nombre'),
        ]);
        $programa->save();

        //Asignar cursos
        $cursos = $request->input('cursos');
        $programa->set_cursos($cursos);

    }

    /**
     * Mostrar datos de un Programa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programa = new Programa();
        $programa = $programa->get_programa($id);
        $cursosPrograma = $programa->cursos();
        return view('programa.show')
            ->with(compact('programa'))
            ->with(compact('cursosPrograma'));

    }

    /**
     * Editar datos de un Programa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener cursos
        $curso = new Curso();
        $cursos = $curso->get_cursos();
        $cursosJson = json_encode($cursos);

        //Obtener programa
        $programa = new Programa();
        $programa = $programa->get_programa($id);
        $cursoProgramas = $programa->get_id_cursos();
        $cursosProgramaArray = json_encode($cursoProgramas);

        return view('programa.edit')
            ->with(compact('cursosProgramaArray'))
            ->with(compact('cursosJson'))
            ->with(compact('programa'));

    }

    /**
     * Actualizar datos de un Programa.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre
        $this->validate($request, [
            'nombre' => 'required|unique:programas,nombre,' . $id,
        ]);

        //Obtener programa
        $programa = new Programa();
        $programa = $programa->get_programa($id);

        //Actulizar datos del programa
        $programa->update([
            'nombre' => $request->input('nombre')
        ]);


        //Asignar nuevos roles
        $cursos = $request->input('cursos');
        $programa->set_cursos($cursos);
    }

    /**
     * Eliminar un Programa.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        $programa = new Programa();
        $programa = $programa->get_programa($id);
        //eliminar cursos
        $programa->del_cursos();
        $programa->delete();
    }
}
