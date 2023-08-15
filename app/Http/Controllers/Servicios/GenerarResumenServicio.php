<?php


namespace App\Http\Controllers\Servicios;


use App\Models\Servicio;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class GenerarResumenServicio
{
    /**
     * Genera archivo Excel del reporte básico de un Servicio.
     ** USO DE LIBRERÍA CON LICENCIA GNU LGPL: https://phpspreadsheet.readthedocs.io/en/latest/
     * @param $servicio Servicio
     */
    public function downloadResumenServicio($servicio)
    {
        //Obtener datos------------------------------------------------------------------------------------------------------------
        $ciudad=$servicio->ciudad();
        if($ciudad==null){
            $ciudad="No Asignado";
        }else{
            $ciudad=$ciudad->nombre;
        }
        $relator=$servicio->relator();
        if($relator==null){
            $relator="No Asignado";
        }else{
            $relator=$relator->nombre;
        }
        $curso=$servicio->curso();
        /*if($curso==null){
            $curso="No Asignado";
        }else{
            $curso=$curso->nombre_venta;
        }*/
        $propuesta=$servicio->propuesta();
        $participantes=$servicio->participantes();
        $empresa=$propuesta->empresa();
        $empresa=$empresa->nombre;


        //Crear LISTA ASISTENCIA------------------------------------------------------------------------------------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: inline; filename=Reporte Básico Servicio.xlsx");

        //Crear planilla
        $planilla= new Spreadsheet();
        $planilla->getProperties()->setTitle("Reporte Básico Servicio");
        //Ajustes por defecto
        $planilla->getDefaultStyle()->getFont()->setName('Calibri')->setSize(15);//Setear fuente y tamaño
        $planilla->getDefaultStyle()->getFont()->setBold(true);

        //obtener la hoja
        $hoja=$planilla->getActiveSheet();
        $hoja->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LETTER);
        $hoja->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $hoja->getPageSetup()->setFitToWidth(1);
        $hoja->getPageSetup()->setFitToHeight(0);
        $hoja->setShowGridLines(false);

        $planilla->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $planilla->getActiveSheet()->getColumnDimension('B')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('C')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('D')->setWidth(8);
        $planilla->getActiveSheet()->getColumnDimension('E')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('F')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('G')->setWidth(8);
        $planilla->getActiveSheet()->getColumnDimension('H')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('I')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('J')->setWidth(8);
        $planilla->getActiveSheet()->getColumnDimension('K')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('L')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('M')->setWidth(8);
        $planilla->getActiveSheet()->getColumnDimension('N')->setWidth(7);
        $planilla->getActiveSheet()->getColumnDimension('O')->setWidth(7);
        //Encabezado----------------------------------------------------------------------------------------------------
        $hoja->mergeCells('D1:L1');
        $hoja->getStyle('D1:L1')->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('D1',"ADS CAPACITACIÓN");
        $drawing= new Drawing();
        $drawing->setName('logo');
        $drawing->setDescription('logo');
        $drawing->setPath(storage_path().'/app/public/imagenes/logo.png');
        $drawing->setHeight(100);
        $drawing->setCoordinates('N1');
        $drawing->setWorksheet($hoja);
        $hoja->mergeCells('D4:L4');
        $hoja->getStyle('D4:L4')->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('D4',"REPORTE BÁSICO SERVICIO");

        //Cuadro general------------------------------------------------------------------------------------------------
        $hoja->getStyle('A6:O14')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $hoja->mergeCells('A6:C6');
        $hoja->getStyle('A6:C6')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A6',"NOMBRE DEL CURSO");
        $hoja->getStyle('A6')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('6')->setRowHeight(50);
        $hoja->mergeCells('D6:O6');
        $hoja->getStyle('D6:O6')->getAlignment()->setVertical('center');
        $hoja->getStyle('D6:O6')->getFont()->setBold(false);
        $hoja->setCellValue('D6',$curso->nombre_venta);
        $hoja->getStyle('D6')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A7:C7');
        $hoja->getStyle('A7:C7')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A7',"CONTENIDO CURSO");
        $hoja->getStyle('A7')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('7')->setRowHeight(80);
        $hoja->mergeCells('D7:O7');
        $hoja->getStyle('D7:O7')->getAlignment()->setVertical('center');
        $hoja->getStyle('D7:O7')->getFont()->setBold(false);
        $hoja->setCellValue('D7',$curso->descripcion);
        $hoja->getStyle('D7')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A8:C8');
        $hoja->getStyle('A8:C8')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A8',"CLIENTE");
        $hoja->getStyle('A8')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('8')->setRowHeight(50);
        $hoja->mergeCells('D8:O8');
        $hoja->getStyle('D8:O8')->getAlignment()->setVertical('center');
        $hoja->getStyle('D8:O8')->getFont()->setBold(false);
        $hoja->setCellValue('D8',$empresa);
        $hoja->getStyle('D8')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A9:C9');
        $hoja->getStyle('A9:C9')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A9',"HORAS DE LA ACTIVIDAD");
        $hoja->getStyle('A9')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('9')->setRowHeight(50);
        $hoja->mergeCells('D9:H9');
        $hoja->getStyle('D9:H9')->getAlignment()->setVertical('center');
        $hoja->getStyle('D9:H9')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D9:H9')->getFont()->setBold(false);
        $hoja->setCellValue('D9',$servicio->cant_horas.' Horas.');
        $hoja->getStyle('D9')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('I9:L9');
        $hoja->getStyle('I9:L9')->getAlignment()->setVertical('center');
        $hoja->setCellValue('I9',"HORARIO");
        $hoja->mergeCells('M9:O9');
        $hoja->getStyle('M9:O9')->getAlignment()->setVertical('center');
        $hoja->getStyle('M9:O9')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M9:O9')->getFont()->setBold(false);
        $hoja->setCellValue('M9',$servicio->horario);
        $hoja->getStyle('M9')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A10:C10');
        $hoja->getStyle('A10:C10')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A10',"HORARIO COFFEE AM");
        $hoja->getRowDimension('10')->setRowHeight(50);
        $hoja->mergeCells('D10:E10');
        $hoja->getStyle('D10:E10')->getAlignment()->setVertical('center');
        $hoja->getStyle('D10:E10')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D10:E10')->getFont()->setBold(false);
        $hoja->setCellValue('D10',$servicio->horario_coffee_am);
        $hoja->getStyle('D10')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('F10:H10');
        $hoja->getStyle('F10:H10')->getAlignment()->setVertical('center');
        $hoja->setCellValue('F10',"HORARIO ALMUERZO");
        $hoja->mergeCells('I10:J10');
        $hoja->getStyle('I10:J10')->getAlignment()->setVertical('center');
        $hoja->getStyle('I10:J10')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('I10:J10')->getFont()->setBold(false);
        $hoja->setCellValue('I10',$servicio->horario_almuerzo);
        $hoja->getStyle('I10')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('K10:M10');
        $hoja->getStyle('K10:M10')->getAlignment()->setVertical('center');
        $hoja->setCellValue('K10',"HORARIO COFFEE PM");
        $hoja->mergeCells('N10:O10');
        $hoja->getStyle('N10:O10')->getAlignment()->setVertical('center');
        $hoja->getStyle('N10:O10')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('N10:O10')->getFont()->setBold(false);
        $hoja->setCellValue('N10',$servicio->horario_coffee_pm);
        $hoja->getStyle('N10')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A11:C11');
        $hoja->getStyle('A11:C11')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A11',"OTEC/EMPRESA");
        $hoja->getStyle('A11')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('11')->setRowHeight(50);
        $hoja->mergeCells('D11:I11');
        $hoja->getStyle('D11:I11')->getAlignment()->setVertical('center');
        $hoja->getStyle('D11:I11')->getFont()->setBold(false);
        $hoja->setCellValue('D11','ADS Capacitación S.A.');
        $hoja->getStyle('D11')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J11:L11');
        $hoja->getStyle('J11:L11')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J11',"RUT");
        $hoja->getStyle('J11')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M11:O11');
        $hoja->getStyle('M11:O11')->getAlignment()->setVertical('center');
        $hoja->getStyle('M11:O11')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M11:O11')->getFont()->setBold(false);
        $hoja->setCellValue('M11',"77.934.650-1");
        $hoja->getStyle('M11')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A12:C12');
        $hoja->getStyle('A12:C12')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A12',"N° ORDEN DE TRABAJO");
        $hoja->getStyle('A12')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('12')->setRowHeight(50);
        $hoja->mergeCells('D12:I12');
        $hoja->getStyle('D12:I12')->getAlignment()->setVertical('center');
        $hoja->getStyle('D12:I12')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D12:I12')->getFont()->setBold(false);
        $hoja->setCellValue('D12',$propuesta->idp);
        $hoja->getStyle('D12')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J12:L12');
        $hoja->getStyle('J12:L12')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J12',"CÓDIGO SENCE");
        $hoja->getStyle('J12')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M12:O12');
        $hoja->getStyle('M12:O12')->getAlignment()->setVertical('center');
        $hoja->getStyle('M12:O12')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M12:O12')->getFont()->setBold(false);
        $hoja->setCellValue('M12',$curso->codigo_sence);
        $hoja->getStyle('M12')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A13:C13');
        $hoja->getStyle('A13:C13')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A13',"FECHA DE EJECUCIÓN");
        $hoja->getStyle('A13')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('13')->setRowHeight(50);
        $hoja->mergeCells('D13:I13');
        $hoja->getStyle('D13:I13')->getAlignment()->setVertical('center');
        $hoja->getStyle('D13:I13')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D13:I13')->getFont()->setBold(false);
        $hoja->setCellValue('D13',date("d-m-Y", strtotime($servicio->fecha_ejecucion)));
        $hoja->getStyle('D13')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J13:L13');
        $hoja->getStyle('J13:L13')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J13',"N° PARTICIPANTES");
        $hoja->getStyle('J13')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M13:O13');
        $hoja->getStyle('M13:O13')->getAlignment()->setVertical('center');
        $hoja->getStyle('M13:O13')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M13:O13')->getFont()->setBold(false);
        $hoja->setCellValue('M13',$servicio->cant_participantes);
        $hoja->getStyle('M13')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A14:C14');
        $hoja->getStyle('A14:C14')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A14',"LUGAR REALIZACIÓN");
        $hoja->getStyle('A14')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('14')->setRowHeight(50);
        $hoja->mergeCells('D14:I14');
        $hoja->getStyle('D14:I14')->getAlignment()->setVertical('center');
        $hoja->getStyle('D14:I14')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D14:I14')->getFont()->setBold(false);
        $hoja->setCellValue('D14',$servicio->lugar_realizacion);
        $hoja->getStyle('D14')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J14:L14');
        $hoja->getStyle('J14:L14')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J14',"SALA");
        $hoja->getStyle('J14')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M14:O14');
        $hoja->getStyle('M14:O14')->getAlignment()->setVertical('center');
        $hoja->getStyle('M14:O14')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M14:O14')->getFont()->setBold(false);
        $hoja->setCellValue('M14',$servicio->salon);
        $hoja->getStyle('M14')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A15:C15');
        $hoja->getStyle('A15:C15')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A15',"RELATOR");
        $hoja->getStyle('A15')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('15')->setRowHeight(50);
        $hoja->mergeCells('D15:I15');
        $hoja->getStyle('D15:I15')->getAlignment()->setVertical('center');
        $hoja->getStyle('D15:I15')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D15:I15')->getFont()->setBold(false);
        $hoja->setCellValue('D15',$relator);
        $hoja->getStyle('D15')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J15:L15');
        $hoja->getStyle('J15:L15')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J15',"ID ACCIÓN");
        $hoja->getStyle('J15')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M15:O15');
        $hoja->getStyle('M15:O15')->getAlignment()->setVertical('center');
        $hoja->getStyle('M15:O15')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M15:O15')->getFont()->setBold(false);
        $hoja->setCellValue('M15',$servicio->id_accion);
        $hoja->getStyle('M15')->getAlignment()->setWrapText(true);
        $hoja->setBreak('A15', Worksheet::BREAK_ROW);
        $fila=16;

        //PARTICIPANTES-------------------------------------------------------------------------------------------------
        $cantFilas=1;
        $numParticipante=1;
        $hoja->getStyle('A'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('A'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('A'.$fila,"N°");
        $hoja->getRowDimension($fila)->setRowHeight(75);
        $hoja->mergeCells('B'.$fila.':C'.$fila);
        $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('B'.$fila,"RUT");
        $hoja->getStyle('B'.$fila)->getAlignment()->setWrapText(true);
        $hoja->mergeCells('D'.$fila.':I'.$fila);
        $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('D'.$fila,"Nombre y Apellidos");
        $hoja->getStyle('D'.$fila)->getAlignment()->setWrapText(true);
        $hoja->mergeCells('J'.$fila.':L'.$fila);
        $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('J'.$fila,"Porcentaje de Asistencia");
        $hoja->getStyle('J'.$fila)->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M'.$fila.':O'.$fila);
        $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('M'.$fila,"Promedio Notas Curso");
        $hoja->getStyle('M'.$fila)->getAlignment()->setWrapText(true);
        $fila=$fila+1;
        foreach ($participantes as $participante){
            $datosParticipante= $servicio->get_participante($participante->id);
            if($datosParticipante==null){
                $datosParticipante= new \stdClass();
                $datosParticipante->asistencia="0%";
                $datosParticipante->avg_nota=0;
            }else{
                $datosParticipante->asistencia=$datosParticipante->asistencia*100;
                $participante->asistencia=$datosParticipante->asistencia."%";
                $participante->promedio=$datosParticipante->avg_nota;
            }
            $hoja->getRowDimension($fila)->setRowHeight(50);
            $hoja->getStyle('A'.$fila.':O'.$fila)->getFont()->setBold(false);
            $hoja->getStyle('A'.$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle('A'.$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue('A'.$fila,$numParticipante);
            $hoja->mergeCells('B'.$fila.':C'.$fila);
            $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue('B'.$fila,$participante->rut);
            $hoja->mergeCells('D'.$fila.':I'.$fila);
            $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue('D'.$fila,$participante->nombre.' '.$participante->apellido);
            $hoja->mergeCells('J'.$fila.':L'.$fila);
            $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue('J'.$fila,$participante->asistencia);
            $hoja->mergeCells('M'.$fila.':O'.$fila);
            $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setVertical('center');
            $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setHorizontal('center');
            $hoja->setCellValue('M'.$fila,$participante->promedio);
            $numParticipante= $numParticipante +1;
            if($cantFilas==10){
                $cantFilas=1;
                $hoja->setBreak('A'.$fila, Worksheet::BREAK_ROW);
                $fila=$fila+1;
                $hoja->getStyle('A'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('A'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('A'.$fila,"N°");
                $hoja->getRowDimension($fila)->setRowHeight(75);
                $hoja->mergeCells('B'.$fila.':C'.$fila);
                $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('B'.$fila.':C'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('B'.$fila,"RUT");
                $hoja->getStyle('B'.$fila)->getAlignment()->setWrapText(true);
                $hoja->mergeCells('D'.$fila.':I'.$fila);
                $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('D'.$fila.':I'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('D'.$fila,"Nombre y Apellidos");
                $hoja->getStyle('D'.$fila)->getAlignment()->setWrapText(true);
                $hoja->mergeCells('J'.$fila.':L'.$fila);
                $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('J'.$fila.':L'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('J'.$fila,"Porcentaje de Asistencia");
                $hoja->getStyle('J'.$fila)->getAlignment()->setWrapText(true);
                $hoja->mergeCells('M'.$fila.':O'.$fila);
                $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('M'.$fila.':O'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('M'.$fila,"Promedio de Notas");
                $hoja->getStyle('M'.$fila)->getAlignment()->setWrapText(true);
                $fila++;
            }else{
                $cantFilas++;
                $fila++;
            }
        }
        $fila--;
        $hoja->getStyle('A15:O'.$fila)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $hoja->setBreak('A'.$fila, Worksheet::BREAK_ROW);
        $fila++;
        //Gráfico de encuesta de satisfacción---------------------------------------------------------------------------
        $hoja->mergeCells('D'.$fila.':L'.$fila);
        $hoja->getStyle('D'.$fila.':L'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('D'.$fila,"RESULTADOS ENCUESTAS DE SATISFACCIÓN DEL CURSO");
        $fila++;
        $columna=3;
        $hoja->mergeCells(Coordinate::stringFromColumnIndex($columna).$fila.':'.Coordinate::stringFromColumnIndex($columna+2).$fila);
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'Categoría');
        $columna+=3;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'Valor');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R1');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R2');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R3');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R4');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R5');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R6');
        $columna++;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'R7');
        $fila++;
        $encuestas=$servicio->encuesta_ads();
        $cantEncuestas=count($encuestas);
        $filaInicial=$fila;
        $columna=3;
        $hoja->mergeCells(Coordinate::stringFromColumnIndex($columna).$fila.':'.Coordinate::stringFromColumnIndex($columna+2).$fila);
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'TOTALMENTE ACUERDO');
        $columna+=3;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'4');
        $fila++;
        $columna=3;
        $hoja->mergeCells(Coordinate::stringFromColumnIndex($columna).$fila.':'.Coordinate::stringFromColumnIndex($columna+2).$fila);
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'ACUERDO');
        $columna+=3;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'3');
        $fila++;
        $columna=3;
        $hoja->mergeCells(Coordinate::stringFromColumnIndex($columna).$fila.':'.Coordinate::stringFromColumnIndex($columna+2).$fila);
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'DESACUERDO');
        $columna+=3;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'2');
        $fila++;
        $columna=3;
        $hoja->mergeCells(Coordinate::stringFromColumnIndex($columna).$fila.':'.Coordinate::stringFromColumnIndex($columna+2).$fila);
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'TOTALMENTE DESACUERDO');
        $columna+=3;
        $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,'1');
        $fila=$filaInicial;
        if($cantEncuestas>0){
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_1==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_1==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_1==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_2==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_2==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_2==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_3==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_3==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_3==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_4==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_4==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_4==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_5==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_5==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_5==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_6==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_6==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_6==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $fila=$filaInicial;
            $respuestaCon4=0;
            $respuestaCon3=0;
            $respuestaCon2=0;
            $respuestaCon1=0;
            foreach ($encuestas as $encuesta){
                if($encuesta->respuesta_7==4){
                    $respuestaCon4++;
                }else{
                    if($encuesta->respuesta_7==3){
                        $respuestaCon3++;
                    }else{
                        if($encuesta->respuesta_7==2){
                            $respuestaCon2++;
                        }else{
                            $respuestaCon1++;
                        }
                    }
                }
            }
            $columna++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon4/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon3/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon2/$cantEncuestas));
            $fila++;
            $hoja->getStyle(Coordinate::stringFromColumnIndex($columna).$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).$fila,($respuestaCon1/$cantEncuestas));
            $columna=3;
            $fila=$filaInicial;
            $dataSeriesLabels = [
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.$fila, null, 1,[],null,'799244'), // totalmente acuerdo
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+1), null, 1,[],null,'91AF53'), // acuerdo
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+2), null, 1,[],null,'AEC683'), // desacuerdo
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+3), null, 1,[],null,'CDDBB8'), // totalmente deacuerdo
            ];
            $columna=7;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'1.-Esta Actividad me entregó conceptos útiles para aplicar en mi trabajo');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'2.-El curso me entregó técnicas concretas que podré aplicar en mi trabajo');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'3.-Las dinámicas y ejercicios realizados favorecieron mi aprendizaje');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'4.-Los consultores/relatores demostraron manejar los contenidos y temas');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'5.-Los consultores/relatores fueron claros en la exposición y explicación de los temas');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'6.-El lugar donde se realizó el entrenamiento fue cómodo y favoreció el desarrollo de la actividad');
            $columna++;
            $hoja->setCellValue(Coordinate::stringFromColumnIndex($columna).($fila+30),'7.-El lugar donde se realizó el entrenamiento cuenta con iluminación y ventilación favorable');
            $columna=7;
            $xAxisTickValues = [
                //new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila-1).':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.($fila-1), null, 7), // R1 a R7
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+30).':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.(($fila+30)), null, 7), // R1 a R7
            ];
            $dataSeriesValues = [
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.$fila.':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.($fila), null, 7), // 4
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+1).':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.($fila+1), null, 7), // 3
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+2).':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.($fila+2), null, 7), // 2
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$'.Coordinate::stringFromColumnIndex($columna).'$'.($fila+3).':$'.Coordinate::stringFromColumnIndex($columna+6).'$'.($fila+3), null, 7), // 1
            ];
            $series = new DataSeries(
                DataSeries::TYPE_BARCHART, // plotType
                DataSeries::GROUPING_PERCENT_STACKED, // plotGrouping
                range(0, count($dataSeriesValues) - 1), // plotOrder
                $dataSeriesLabels, // plotLabel
                $xAxisTickValues, // plotCategory
                $dataSeriesValues        // plotValues
            );
            $series->setPlotDirection(DataSeries::DIRECTION_BAR);
            $plotArea = new PlotArea(null, [$series]);
            $legend = new Legend(Legend::POSITION_BOTTOM, null, false);
            $title = new Title('Evaluación de Satisfacción del Curso');
            $yAxis = new Axis();
            $yAxis->setAxisOptionsProperties(
                Axis::AXIS_LABELS_NEXT_TO,
                null,
                Axis::HORIZONTAL_CROSSES_AUTOZERO,
                Axis::ORIENTATION_REVERSED,
                null,
                null,
                null,
                null,
                null
            );
            $chart = new Chart(
                'Gráfico', // name
                $title, // title
                $legend, // legend
                $plotArea, // plotArea
                true, // plotVisibleOnly
                0, // displayBlanksAs
                null, // xAxisLabel
                null,  // yAxisLabel
                null,
                $yAxis
            );
            $chart->setTopLeftPosition('C'.($fila+6));
            $chart->setBottomRightPosition('N'.($fila+24));
            $hoja->addChart($chart);
        }
        //--------------------------------------------------------------------------------------------------------------
        $fila=$fila-1;
        $hoja->setBreak('A'.($fila+26), Worksheet::BREAK_ROW);
        $hoja->getPageSetup()->setPrintArea('A1:O'.($fila+26));
        $escritor= IOFactory::createWriter($planilla,'Xlsx');
        $escritor->setIncludeCharts(true);
        //$escritor= IOFactory::createWriter($planilla,'Tcpdf');
        $escritor->save('php://output');
    }
}