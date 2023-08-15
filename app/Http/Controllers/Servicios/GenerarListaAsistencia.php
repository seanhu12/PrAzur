<?php


namespace App\Http\Controllers\Servicios;


use App\Models\Servicio;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenerarListaAsistencia
{
    /**
     * Genera archivo Excel de checklist de un Servicio.
     ** USO DE LIBRERÍA CON LICENCIA GNU LGPL: https://phpspreadsheet.readthedocs.io/en/latest/
     * @param $servicio Servicio
     */
    public function downloadListaAsistencia($servicio)
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
        header("Content-Disposition: inline; filename=Lista Asistencia.xlsx");

        //Crear planilla
        $planilla= new Spreadsheet();
        $planilla->getProperties()->setTitle("Lista Asistencia");
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
        //Encabezado-----------------------------------------------------------------------------------------------------------
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
        $hoja->setCellValue('D4',"LIBRO DE CLASES Y REGISTRO DE ASISTENCIA");

        //Cuadro general-------------------------------------------------------------------------------------------------------
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
        $hoja->setCellValue('A7',"CLIENTE");
        $hoja->getStyle('A7')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('7')->setRowHeight(50);
        $hoja->mergeCells('D7:O7');
        $hoja->getStyle('D7:O7')->getAlignment()->setVertical('center');
        $hoja->getStyle('D7:O7')->getFont()->setBold(false);
        $hoja->setCellValue('D7',$empresa);
        $hoja->getStyle('D7')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A8:C8');
        $hoja->getStyle('A8:C8')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A8',"HORAS DE LA ACTIVIDAD");
        $hoja->getStyle('A8')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('8')->setRowHeight(50);
        $hoja->mergeCells('D8:H8');
        $hoja->getStyle('D8:H8')->getAlignment()->setVertical('center');
        $hoja->getStyle('D8:H8')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D8:H8')->getFont()->setBold(false);
        $hoja->setCellValue('D8',$servicio->cant_horas.' Horas.');
        $hoja->getStyle('D8')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('I8:L8');
        $hoja->getStyle('I8:L8')->getAlignment()->setVertical('center');
        $hoja->setCellValue('I8',"HORARIO");
        $hoja->mergeCells('M8:O8');
        $hoja->getStyle('M8:O8')->getAlignment()->setVertical('center');
        $hoja->getStyle('M8:O8')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M8:O8')->getFont()->setBold(false);
        $hoja->setCellValue('M8',$servicio->horario);
        $hoja->getStyle('M8')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A9:C9');
        $hoja->getStyle('A9:C9')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A9',"HORARIO COFFEE AM");
        $hoja->getRowDimension('9')->setRowHeight(50);
        $hoja->mergeCells('D9:E9');
        $hoja->getStyle('D9:E9')->getAlignment()->setVertical('center');
        $hoja->getStyle('D9:E9')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D9:E9')->getFont()->setBold(false);
        $hoja->setCellValue('D9',$servicio->horario_coffee_am);
        $hoja->getStyle('D9')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('F9:H9');
        $hoja->getStyle('F9:H9')->getAlignment()->setVertical('center');
        $hoja->setCellValue('F9',"HORARIO ALMUERZO");
        $hoja->mergeCells('I9:J9');
        $hoja->getStyle('I9:J9')->getAlignment()->setVertical('center');
        $hoja->getStyle('I9:J9')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('I9:J9')->getFont()->setBold(false);
        $hoja->setCellValue('I9',$servicio->horario_almuerzo);
        $hoja->getStyle('I9')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('K9:M9');
        $hoja->getStyle('K9:M9')->getAlignment()->setVertical('center');
        $hoja->setCellValue('K9',"HORARIO COFFEE PM");
        $hoja->mergeCells('N9:O9');
        $hoja->getStyle('N9:O9')->getAlignment()->setVertical('center');
        $hoja->getStyle('N9:O9')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('N9:O9')->getFont()->setBold(false);
        $hoja->setCellValue('N9',$servicio->horario_coffee_pm);
        $hoja->getStyle('N9')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A10:C10');
        $hoja->getStyle('A10:C10')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A10',"OTEC/EMPRESA");
        $hoja->getStyle('A10')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('10')->setRowHeight(50);
        $hoja->mergeCells('D10:I10');
        $hoja->getStyle('D10:I10')->getAlignment()->setVertical('center');
        $hoja->getStyle('D10:I10')->getFont()->setBold(false);
        $hoja->setCellValue('D10','ADS Capacitación S.A.');
        $hoja->getStyle('D10')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J10:L10');
        $hoja->getStyle('J10:L10')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J10',"RUT");
        $hoja->getStyle('J10')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M10:O10');
        $hoja->getStyle('M10:O10')->getAlignment()->setVertical('center');
        $hoja->getStyle('M10:O10')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M10:O10')->getFont()->setBold(false);
        $hoja->setCellValue('M10',"77.934.650-1");
        $hoja->getStyle('M10')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A11:C11');
        $hoja->getStyle('A11:C11')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A11',"N° ORDEN DE TRABAJO");
        $hoja->getStyle('A11')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('11')->setRowHeight(50);
        $hoja->mergeCells('D11:I11');
        $hoja->getStyle('D11:I11')->getAlignment()->setVertical('center');
        $hoja->getStyle('D11:I11')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D11:I11')->getFont()->setBold(false);
        $hoja->setCellValue('D11',$propuesta->idp);
        $hoja->getStyle('D11')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J11:L11');
        $hoja->getStyle('J11:L11')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J11',"CÓDIGO SENCE");
        $hoja->getStyle('J11')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M11:O11');
        $hoja->getStyle('M11:O11')->getAlignment()->setVertical('center');
        $hoja->getStyle('M11:O11')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M11:O11')->getFont()->setBold(false);
        $hoja->setCellValue('M11',$curso->codigo_sence);
        $hoja->getStyle('M11')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A12:C12');
        $hoja->getStyle('A12:C12')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A12',"FECHA DE EJECUCIÓN");
        $hoja->getStyle('A12')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('12')->setRowHeight(50);
        $hoja->mergeCells('D12:I12');
        $hoja->getStyle('D12:I12')->getAlignment()->setVertical('center');
        $hoja->getStyle('D12:I12')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D12:I12')->getFont()->setBold(false);
        $hoja->setCellValue('D12',date("d-m-Y", strtotime($servicio->fecha_ejecucion)));
        $hoja->getStyle('D12')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J12:L12');
        $hoja->getStyle('J12:L12')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J12',"N° PARTICIPANTES");
        $hoja->getStyle('J12')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M12:O12');
        $hoja->getStyle('M12:O12')->getAlignment()->setVertical('center');
        $hoja->getStyle('M12:O12')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M12:O12')->getFont()->setBold(false);
        $hoja->setCellValue('M12',$servicio->cant_participantes);
        $hoja->getStyle('M12')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A13:C13');
        $hoja->getStyle('A13:C13')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A13',"LUGAR REALIZACIÓN");
        $hoja->getStyle('A13')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('13')->setRowHeight(50);
        $hoja->mergeCells('D13:I13');
        $hoja->getStyle('D13:I13')->getAlignment()->setVertical('center');
        $hoja->getStyle('D13:I13')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D13:I13')->getFont()->setBold(false);
        $hoja->setCellValue('D13',$servicio->lugar_realizacion);
        $hoja->getStyle('D13')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J13:L13');
        $hoja->getStyle('J13:L13')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J13',"SALA");
        $hoja->getStyle('J13')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M13:O13');
        $hoja->getStyle('M13:O13')->getAlignment()->setVertical('center');
        $hoja->getStyle('M13:O13')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M13:O13')->getFont()->setBold(false);
        $hoja->setCellValue('M13',$servicio->salon);
        $hoja->getStyle('M13')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('A14:C14');
        $hoja->getStyle('A14:C14')->getAlignment()->setVertical('center');
        $hoja->setCellValue('A14',"RELATOR");
        $hoja->getStyle('A14')->getAlignment()->setWrapText(true);
        $hoja->getRowDimension('14')->setRowHeight(50);
        $hoja->mergeCells('D14:I14');
        $hoja->getStyle('D14:I14')->getAlignment()->setVertical('center');
        $hoja->getStyle('D14:I14')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('D14:I14')->getFont()->setBold(false);
        $hoja->setCellValue('D14',$relator);
        $hoja->getStyle('D14')->getAlignment()->setWrapText(true);

        $hoja->mergeCells('J14:L14');
        $hoja->getStyle('J14:L14')->getAlignment()->setVertical('center');
        $hoja->setCellValue('J14',"ID ACCIÓN");
        $hoja->getStyle('J14')->getAlignment()->setWrapText(true);
        $hoja->mergeCells('M14:O14');
        $hoja->getStyle('M14:O14')->getAlignment()->setVertical('center');
        $hoja->getStyle('M14:O14')->getAlignment()->setHorizontal('left');
        $hoja->getStyle('M14:O14')->getFont()->setBold(false);
        $hoja->setCellValue('M14',$servicio->id_accion);
        $hoja->getStyle('M14')->getAlignment()->setWrapText(true);
        $hoja->setBreak('A14', Worksheet::BREAK_ROW);
        $fila=15;

        //PARTICIPANTES-----------------------------------------------------------------------------------------------------------
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
        $hoja->mergeCells('J'.$fila.':K'.$fila);
        $hoja->getStyle('J'.$fila.':K'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('J'.$fila.':K'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('J'.$fila,"Firma");
        $hoja->getStyle('J'.$fila)->getAlignment()->setWrapText(true);
        $hoja->mergeCells('L'.$fila.':M'.$fila);
        $hoja->getStyle('L'.$fila.':M'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('L'.$fila.':M'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('L'.$fila,"Recibí Conforme Material Curso");
        $hoja->getStyle('L'.$fila)->getAlignment()->setWrapText(true);
        $hoja->mergeCells('N'.$fila.':O'.$fila);
        $hoja->getStyle('N'.$fila.':O'.$fila)->getAlignment()->setVertical('center');
        $hoja->getStyle('N'.$fila.':O'.$fila)->getAlignment()->setHorizontal('center');
        $hoja->setCellValue('N'.$fila,"Recibí Conforme Derechos y Deberes");
        $hoja->getStyle('N'.$fila)->getAlignment()->setWrapText(true);
        $fila=$fila+1;
        foreach ($participantes as $participante){
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
            $hoja->mergeCells('J'.$fila.':K'.$fila);
            $hoja->mergeCells('L'.$fila.':M'.$fila);
            $hoja->mergeCells('N'.$fila.':O'.$fila);
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
                $hoja->mergeCells('J'.$fila.':K'.$fila);
                $hoja->getStyle('J'.$fila.':K'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('J'.$fila.':K'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('J'.$fila,"Firma");
                $hoja->getStyle('J'.$fila)->getAlignment()->setWrapText(true);
                $hoja->mergeCells('L'.$fila.':M'.$fila);
                $hoja->getStyle('L'.$fila.':M'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('L'.$fila.':M'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('L'.$fila,"Recibí Conforme Material Curso");
                $hoja->getStyle('L'.$fila)->getAlignment()->setWrapText(true);
                $hoja->mergeCells('N'.$fila.':O'.$fila);
                $hoja->getStyle('N'.$fila.':O'.$fila)->getAlignment()->setVertical('center');
                $hoja->getStyle('N'.$fila.':O'.$fila)->getAlignment()->setHorizontal('center');
                $hoja->setCellValue('N'.$fila,"Recibí Conforme Derechos y Deberes");
                $hoja->getStyle('N'.$fila)->getAlignment()->setWrapText(true);
                $fila=$fila+1;
            }else{
                $cantFilas=$cantFilas+1;
                $fila=$fila+1;
            }
        }
        $fila=$fila-1;
        $hoja->getStyle('A15:O'.$fila)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $hoja->getPageSetup()->setPrintArea('A1:O'.$fila);
        $escritor= IOFactory::createWriter($planilla,'Xlsx');
        //$escritor= IOFactory::createWriter($planilla,'Tcpdf');
        $escritor->save('php://output');
    }
}