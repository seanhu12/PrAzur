<?php

namespace App\Http\Controllers;

use App\Models\ContactoOtic;
use App\Http\Requests\createContactoOticRequest;
use Illuminate\Http\Request;
use App\Models\Otic;

class ContactoOticController extends Controller
{
    /**
     * Desplegar Contactos de OTIC.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener otics
        $otic = new Otic;
        $otics = $otic->get_otics();
        $oticsJson = json_encode($otics);
        //Obtener todos los contactos
        $contactoOtic = new ContactoOtic();
        $contactosOtic = $contactoOtic->get_contactos();
        $otics = Array();
        foreach ($contactosOtic as $contacto){
            array_push($otics,$contacto->otic());
        }

        return view('contacto_otic.index')
            ->with(compact('contactosOtic'))
            ->with(compact('oticsJson'))
            ->with(compact('otics'));
    }

    /**
     * Crear un Contacto de OTIC.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener otics
        $otic = new Otic;
        $otics = $otic->get_otics();
        $oticsJson = json_encode($otics);

        return view('contacto_otic.create')
            ->with(compact('oticsJson'));
    }

    /**
     * Guardar un Contacto de OTIC.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createContactoOticRequest $request)
    {
        //Almacenar contacto OTIC
        $contactoOtic = new ContactoOtic([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'area' => $request->input('area'),
            'otic_id' => $request->input('otic')
        ]);
        $contactoOtic->save();
    }

    /**
     * Mostrar datos de un Contacto de OTIC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Obtener contacto
        $contactoOtic = new ContactoOtic();
        $contactoOtic = $contactoOtic->get_contacto($id);
        $otic =$contactoOtic->otic();

        return view('contacto_otic.show')
            ->with(compact('contactoOtic'))
            ->with(compact('otic'));
    }

    /**
     * Editar datos de un Contacto de OTIC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener contacto
        $contactoOtic = new ContactoOtic();
        $contactoOtic = $contactoOtic->get_contacto($id);
        //Obtener otic
        $otic=$contactoOtic->otic();
        $oticId=$otic->id;
        //Obtener otics
        $otic = new Otic();
        $otics = $otic->get_otics();
        $oticsJson = json_encode($otics);

        return view('contacto_otic.edit')
            ->with(compact('contactoOtic'))
            ->with(compact('oticId'))
            ->with(compact('oticsJson'));
    }

    /**
     * Actualizar datos de un Contacto de OTIC.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validación nombre
        $this->validate($request, [
            'mail' => 'required'
        ]);
        //Obtener contacto
        $contactoOtic = new ContactoOtic();
        $contactoOtic = $contactoOtic->get_contacto($id);

        //Actualizar contacto
        $contactoOtic->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'mail' => $request->input('mail'),
            'telefono_fijo' => $request->input('telefono_fijo'),
            'celular' => $request->input('celular'),
            'direccion' => $request->input('direccion'),
            'area' => $request->input('area'),
            'otic_id' => $request->input('otic')
        ]);
    }

    /**
     * Eliminar un Contacto de OTIC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->input('id');
        //Obtener contacto
        $contactoOtic = new ContactoOtic();
        $contactoOtic = $contactoOtic->get_contacto($id);

        $contactoOtic->delete();
    }
}
