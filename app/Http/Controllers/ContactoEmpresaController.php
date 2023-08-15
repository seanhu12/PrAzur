<?php

namespace App\Http\Controllers;

use App\Models\ContactoEmpresa;
use App\Http\Requests\createContactoEmpresaRequest;
use Illuminate\Http\Request;
use App\Models\Empresa;
use phpDocumentor\Reflection\Types\Array_;

class ContactoEmpresaController extends Controller
{
    /**
     * Desplegar lista de Contactos de Empresas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener empresas
        $empresa= new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);
        //Obtener Contactos
        $contactoEmpresa = new ContactoEmpresa();
        $contactosEmpresa = $contactoEmpresa->get_contactos();
        $empresas = Array();
        foreach ($contactosEmpresa as $contacto){
            array_push($empresas,$contacto->empresa());
        }

        return view('contacto_empresa.index')
            ->with(compact('contactosEmpresa'))
            ->with(compact('empresasJson'))
            ->with(compact('empresas'));
    }

    /**
     * Crear un Contacto de Empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener empresas
        $empresa= new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        return view('contacto_empresa.create')
            ->with(compact('empresasJson'));
    }

    /**
     * Guardar un Contacto de Empresa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createContactoEmpresaRequest $request)
    {
        //Almacenar contacto empresa
        $contactoEmpresa = new ContactoEmpresa([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'area' => $request->input('area'),
            'cargo' => $request->input('cargo'),
            'empresa_id' => $request->input('empresa')
        ]);
        $contactoEmpresa->save();
    }

    /**
     * Mostrar datos de un Contacto de Empresa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener contacto
        $contactoEmpresa = new ContactoEmpresa();
        $contactoEmpresa = $contactoEmpresa->get_contacto($id);
        $empresa =$contactoEmpresa->empresa();

        return view('contacto_empresa.show')
            ->with(compact('contactoEmpresa'))
            ->with(compact('empresa'));
    }

    /**
     * Editar datos de un Contacto de Empresa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener contacto
        $contactoEmpresa = new ContactoEmpresa();
        $contactoEmpresa = $contactoEmpresa->get_contacto($id);
        //Obtener empresa
        $empresa=$contactoEmpresa->empresa();
        $empresaId= $empresa->id;
        //Obtener empresas
        $empresa= new Empresa();
        $empresas = $empresa->get_empresas();
        $empresasJson = json_encode($empresas);

        return view('contacto_empresa.edit')
            ->with(compact('empresasJson'))
            ->with(compact('empresaId'))
            ->with(compact('contactoEmpresa'));
    }

    /**
     * Actualizar datos de un Contacto de Empresa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre
        $this->validate($request, [
            'mail' => 'required'
        ]);
        //Obtener contacto
        $contactoEmpresa = new ContactoEmpresa();
        $contactoEmpresa = $contactoEmpresa->get_contacto($id);

        //Actualizar contacto
        $contactoEmpresa->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'area' => $request->input('area'),
            'cargo' => $request->input('cargo'),
            'empresa_id' => $request->input('empresa')
        ]);
    }

    /**
     * Eliminar un Contacto de Empresa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener contacto
        $contactoEmpresa = new ContactoEmpresa();
        $contactoEmpresa = $contactoEmpresa->get_contacto($id);

        $contactoEmpresa->delete();
    }
}
