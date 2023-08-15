<?php


namespace App\Http\Controllers\Servicios;


use App\Models\Participante;
use App\Models\Propuesta;
use App\Models\Servicio;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportarDatosParticipantesPrograma
{
    /**
     * Genera archivo Excel con los datos de los participantes de un Programa.
     ** USO DE LIBRERÍA CON LICENCIA GNU LGPL: https://phpspreadsheet.readthedocs.io/en/latest/
     * @param $servicio Servicio
     */
    public function downloadDatosParticipantesPrograma($idPropuesta)
    {
        $propuesta=new Propuesta();
        $propuesta=$propuesta->get_propuesta($idPropuesta);
        $participantes=$propuesta->get_participantes();
        $programa=$propuesta->programa();
        $cantidadCursos=count($programa->cursos());
        $datosParticipantes= array();
        $cantidadMinima=99;
        foreach ($participantes as $participant){
            $participante= new Participante();
            $participante=$participante->get_participante($participant->participante_id);
            $servicio= new Servicio();
            $datosParticipante= new \stdClass();
            $datos=$participante->get_datos_programa($propuesta->id);
            $asistencia=0;
            $promedio=0;
            $cantidad=0;
            $cantidadPruebas=0;
            $cantidadEvaluaciones=0;
            $cantidadGuias=0;
            $promedioPruebas=array();
            $promedioGuias=array();
            $promedioEvaluaciones=array();
            $notasTest=array();
            $notasRetest=array();
            $promediosServicios= array();
            $asistenciasServicios= array();
            if($datos==null|| count($datos)==0){
                $cantidadMinima=0;
            }else{
                foreach ($datos as $dato){
                    $cantidad++;
                    $cantidadPruebas++;
                    $cantidadEvaluaciones++;
                    $cantidadGuias++;
                    $servicio=$servicio->get_servicio($dato->servicio_id);
                    $prom=$participante->get_evaluacion_participante_tipo($servicio->id, "evaluacion");
                    if($prom==null){
                        $cantidadEvaluaciones--;
                    }else{
                        $promedioEvaluaciones= array_merge($promedioEvaluaciones,$prom);
                    }
                    $prom=$participante->get_evaluacion_participante_tipo($servicio->id, "guia");
                    if($prom==null){
                        $cantidadGuias--;
                    }else{
                        $promedioGuias= array_merge($promedioGuias,$prom);
                    }
                    $prom=$participante->get_evaluacion_participante_tipo($servicio->id, "prueba");
                    if($prom==null){
                        $cantidadPruebas--;
                    }else{
                        $promedioPruebas= array_merge($promedioPruebas,$prom);
                    }
                    $notaTest=$servicio->get_participante_promedio_tipo($dato->participante_id, "test");
                    if($notaTest==null){
                        $notaTest=1.0;
                    }else{
                        $notaTest=$notaTest->avg_nota;
                    }
                    $notaRetest=$servicio->get_participante_promedio_tipo($dato->participante_id, "retest");
                    if($notaRetest==null){
                        $notaRetest=1.0;
                    }else{
                        $notaRetest=$notaRetest->avg_nota;
                    }
                    $asistenciaYPromedio=$servicio->get_participante($dato->participante_id);
                    if($asistenciaYPromedio!=null){
                        $datosParticipante->nombre=$asistenciaYPromedio->nombre;
                        $datosParticipante->rut=$asistenciaYPromedio->rut;
                        $datosParticipante->vigencia=$asistenciaYPromedio->vigencia;
                        $asistencia= $asistencia+ $asistenciaYPromedio->asistencia;
                        $promedio= $promedio + $asistenciaYPromedio->avg_nota;
                        array_push($promediosServicios,$asistenciaYPromedio->avg_nota);
                        array_push($asistenciasServicios,$asistenciaYPromedio->asistencia);
                    }else{
                        $datosParticipante->nombre=$participante->nombre." ".$participante->apellido;
                        $datosParticipante->rut=$participante->rut;
                        $promedio++;
                        $datosParticipante->vigencia=0;
                        array_push($promediosServicios,1.0);
                        array_push($asistenciasServicios,0);
                    }
                    array_push($notasTest,$notaTest);
                    array_push($notasRetest,$notaRetest);
                }
                if($cantidad==0){
                    $asistencia=0;
                    $promedio=1.0;
                    $promedioPruebas=1.0;
                    $promedioGuias=1.0;
                    $promedioEvaluaciones=1.0;
                }else{
                    if($cantidadGuias>0){
                        $cantidadGuias=sizeof($promedioGuias);
                        $promedioGuias=array_sum($promedioGuias)/$cantidadGuias;
                    }else{
                        $promedioGuias=0;
                    }
                    if($cantidadPruebas>0){
                        $cantidadPruebas=sizeof($promedioPruebas);
                        $promedioPruebas=array_sum($promedioPruebas)/$cantidadPruebas;
                    }else{
                        $promedioPruebas=0;
                    }
                    if($cantidadEvaluaciones>0){
                        $cantidadEvaluaciones=sizeof($promedioEvaluaciones);
                        $promedioEvaluaciones=array_sum($promedioEvaluaciones)/$cantidadEvaluaciones;
                    }else{
                        $promedioEvaluaciones=0;
                    }
                    $asistencia=$asistencia/$cantidadCursos;
                    $promedio=$promedio+$cantidadCursos-$cantidad;
                    $promedio=$promedio/$cantidadCursos;
                }
                if($cantidad<$cantidadMinima){
                    $cantidadMinima=$cantidad;
                }
                $datosParticipante->asistencia=$asistencia*100;
                $datosParticipante->promedio=$promedio;
                $datosParticipante->promedios=$promediosServicios;
                $datosParticipante->tests=$notasTest;
                $datosParticipante->retests=$notasRetest;
                $datosParticipante->guias=$promedioGuias;
                $datosParticipante->pruebas=$promedioPruebas;
                $datosParticipante->evaluaciones=$promedioEvaluaciones;
                $datosParticipante->asistencias=$asistenciasServicios;
                $datosParticipante->faena=$participante->faena;
                $datosParticipante->ciudad=$servicio->ciudad()->nombre;
                //estado
                if($datosParticipante->asistencia>=75 && $datosParticipante->promedio>=6){
                    $datosParticipante->estado="Aprobación con Distinción";
                }else{
                    if($datosParticipante->asistencia>=75 && $datosParticipante->promedio>=4 && $datosParticipante->promedio<6){
                        $datosParticipante->estado="Aprobación";
                    }else{
                        if(($datosParticipante->asistencia>=50 && $datosParticipante->promedio<4)||($datosParticipante->asistencia<75 &&$datosParticipante->asistencia>=50 && $datosParticipante->promedio>=4)){
                            $datosParticipante->estado="Participación";
                        }else{
                            $datosParticipante->estado="Reprobación";
                        }
                    }
                }
                //categoria
                if($datosParticipante->asistencia>=75 && $datosParticipante->promedio>=6){
                    $datosParticipante->categoria="A";
                }else{
                    if($datosParticipante->asistencia>=75 && $datosParticipante->promedio>=4 && $datosParticipante->promedio<6){
                        $datosParticipante->categoria="B";
                    }else{
                        if(($datosParticipante->asistencia<75 && $datosParticipante->promedio<4&& $datosParticipante->promedio>=3)){
                            $datosParticipante->categoria="C";
                        }else{
                            $datosParticipante->categoria="D";
                        }
                    }
                }
                array_push($datosParticipantes,$datosParticipante);
            }
        }


        //Crear LISTA ASISTENCIA------------------------------------------------------------------------------------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: inline; filename=Datos Participantes Programa.xlsx");

        //Crear planilla
        $planilla= new Spreadsheet();
        $planilla->getProperties()->setTitle("Datos Participantes");
        //Ajustes por defecto
        $planilla->getDefaultStyle()->getFont()->setName('Calibri')->setSize(11);//Setear fuente y tamaño
        $planilla->getDefaultStyle()->getFont()->setBold(true);
        //obtener la hoja
        $hoja=$planilla->getActiveSheet();


        $fila=1;
        $columna=1;//A
        //PARTICIPANTES-----------------------------------------------------------------------------------------------------------
        $cantFilas=1;
        $numParticipante=1;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"N°");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"RUT");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Nombre y Apellidos");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Ciudad");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Faena");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Vigencia");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        for($i=0;$i<$cantidadMinima;$i++){
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Promedio Módulo".($i+1));
            $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
            $columna++;
        }
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Promedio Pruebas");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Promedio Guías");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Promedio Evaluaciones");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        for($i=0;$i<$cantidadMinima;$i++){
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Nota Test Módulo".($i+1));
            $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Nota ReTest Módulo".($i+1));
            $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
            $columna++;
        }
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Promedio Final");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        for($i=0;$i<$cantidadMinima;$i++){
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Asistencia Módulo".($i+1));
            $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
            $columna++;
        }
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Porcentaje Asistencia");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Estado");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,"Categoría");
        $hoja->getColumnDimension(Coordinate::stringFromColumnIndex($columna))->setAutoSize(true);
        $columna++;
        $fila++;
        foreach ($datosParticipantes as $participante){
            $columna=1;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$numParticipante);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->rut);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->nombre);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->ciudad);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->faena);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->vigencia);
            $columna++;
            for($i=0;$i<$cantidadMinima;$i++){
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->promedios[$i]);
                $columna++;
            }
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->pruebas);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->guias);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->evaluaciones);
            $columna++;
            for($i=0;$i<$cantidadMinima;$i++){
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->tests[$i]);
                $columna++;
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->retests[$i]);
                $columna++;
            }
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->promedio);
            $columna++;
            for($i=0;$i<$cantidadMinima;$i++){
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->asistencias[$i]);
                $columna++;
            }
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->asistencia."%");
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->estado);
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setBold(false);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$participante->categoria);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setWrapText(true);
            $columna++;
            $numParticipante++;
            $fila++;
        }
        $fila=$fila-1;
        $escritor= IOFactory::createWriter($planilla,'Xlsx');
        //$escritor= IOFactory::createWriter($planilla,'Tcpdf');
        $escritor->save('php://output');
    }

    function getNameFromNumber($num) {
        $numeric = ($num - 1) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);
        if ($num2 > 0) {
            return getNameFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }

}