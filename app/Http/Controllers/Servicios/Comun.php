<?php

namespace App\Http\Controllers\Servicios;

class Comun
{

    /**
     * Convertir arreglo al formato que necesita un tag-input
     *
     * @param arreglo
     * @return arregloJson con formato tag-input
     */
    /*public function arregloFormatoTagInput($arreglo){
        $arregloJson = array();
        foreach($arreglo as $item){
            array_push($arregloJson, ["name" => "$item","value" => "$item"]);
        }
        return $arregloJson;
    }*/

    /**
     * Convertir arreglo al formato que necesita un tag-input
     *
     * @param arreglo
     * @return arregloJson con formato tag-input
     */
    public function fechaFormatoPalabras($fecha){
        $meses = ["Mes", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre",];
        $arreglo=explode("-",$fecha);
        $arreglo[1]=ltrim($arreglo[1],"0");
        $nuevaFecha=$arreglo[2]." de ".$meses[$arreglo[1]]." de ".$arreglo[0];

        return $nuevaFecha;
    }

    /**
     * Convertir mes a texto espaniol
     *
     * @param arreglo
     * @return arregloJson con formato tag-input
     */
    public function mes($mes){
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre",];
        $mes = ltrim($mes,"0");
        $nuevoMes = $meses[$mes - 1];

        return $nuevoMes;
    }

    /**
     * Convertir mes a texto espaniol
     *
     * @param arreglo
     * @return arregloJson con formato tag-input
     */
    public function mesCorto($mes){
        $meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic",];
        $mes = ltrim($mes,"0");
        $nuevoMes = $meses[$mes - 1];

        return $nuevoMes;
    }
}