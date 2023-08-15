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

class GenerarGafetes
{
    /**
     * Genera archivo Excel con los gafetes datos de los participantes de un Servicio.
     ** USO DE LIBRERÍA CON LICENCIA GNU LGPL: https://phpspreadsheet.readthedocs.io/en/latest/
     * @param $servicio Servicio
     */
    public function downloadGafetesServicio($servicio)
    {
        //Obtener participantes
        $participantes=$servicio->participantes();
        $cantParticipantes=count($participantes);

        //Crear Gafetes------------------------------------------------------------------------------------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: inline; filename=Gafetes Participantes Servicio.xlsx");

        //Crear planilla
        $planilla= new Spreadsheet();
        $planilla->getProperties()->setTitle("Gafetes Participantes");
        //Ajustes por defecto
        $planilla->getDefaultStyle()->getFont()->setName('Calibri')->setSize(36);//Setear fuente y tamaño
        $planilla->getDefaultStyle()->getFont()->setBold(true);
        //obtener la hoja
        $hoja=$planilla->getActiveSheet();
        $hoja->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LETTER);
        $hoja->getPageMargins()->setTop(0);
        $hoja->getPageMargins()->setBottom(0);
        $hoja->getPageMargins()->setLeft(0);
        $hoja->getPageMargins()->setRight(0);
        //$hoja->getDefaultColumnDimension()->setWidth(720/54); //prototipo
        $hoja->getDefaultColumnDimension()->setWidth(6552/459);
        //$hoja->setShowGridLines(false);
        $fila=1;
        $columna=1;//A
        $cantGafetes=0;
        //PARTICIPANTES-----------------------------------------------------------------------------------------------------------
        foreach ($participantes as $participante){
            if($cantGafetes==10){
                $fila--;
                $hoja->setBreak('A'.$fila, Worksheet::BREAK_ROW);
                $fila++;
                $cantGafetes=0;
                $columna=1;
            }
            if($cantGafetes%2==0){//par columna A
                $columna=1;
            }else {//impar columna B
                $columna = 2;
                $fila= $fila-2;
            }
            $nombre=$participante->nombre;
            if(strlen($nombre)<=10){
                $nameSize=36;
            }else{
                if(strlen($nombre)<=20){
                    $nameSize=32;
                }else{
                    $nameSize=28;
                }
            }
            $apellido=$participante->apellido;
            if(strlen($apellido)<=10){
                $lastNameSize=14;
            }else{
                if(strlen($nombre)<=20){
                    $lastNameSize=12;
                }else{
                    $lastNameSize=10;
                }
            }
            $drawing= new Drawing();
            $drawing->setName('logo');
            $drawing->setDescription('logo');
            $drawing->setPath(storage_path().'/app/public/imagenes/logo.png');
            $drawing->setHeight(65);
            $drawing->setWorksheet($hoja);
            $drawing->setCoordinates(Coordinate::stringFromColumnIndex($columna).$fila);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setName('Calibri')->setSize($nameSize);//Setear fuente y tamaño
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            //$hoja->getRowDimension($fila)->setRowHeight(126);//prototipo
            $hoja->getRowDimension($fila)->setRowHeight(105121.8/818.85);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$nombre);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setWrapText(true);
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getFont()->setName('Calibri')->setSize($lastNameSize);//Setear fuente y tamaño
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setVertical('top');
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setHorizontal('center');
            //$hoja->getRowDimension($fila)->setRowHeight(28.5);//prototipo
            $hoja->getRowDimension($fila)->setRowHeight(23777.55/818.85);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,$apellido);
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getAlignment()->setWrapText(true);
            $fila++;
            $cantGafetes++;
        }
        if($cantParticipantes<=10){
            $hoja->getPageSetup()->setPrintArea('A1:B10');
        }else{
            $cantPaginas=($cantParticipantes/10);
            $cantPaginas= ceil($cantPaginas);
            $ultimaFila=$cantPaginas*10;
            $hoja->getPageSetup()->setPrintArea('A1:B'.$ultimaFila);
        }
        $fila=$fila-1;
        $escritor= IOFactory::createWriter($planilla,'Xlsx');
        //$escritor= IOFactory::createWriter($planilla,'Tcpdf');
        $escritor->save('php://output');
    }



}