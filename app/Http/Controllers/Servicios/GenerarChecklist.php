<?php


namespace App\Http\Controllers\Servicios;


use App\Models\CheckAudioIluminacion;
use App\Models\CheckCierre;
use App\Models\CheckCoordinacion;
use App\Models\CheckMaterialParticipante;
use App\Models\CheckMaterialRelator;
use App\Models\CheckOutdoor;
use App\Models\CheckSence;
use App\Models\DisenoTecnico;
use App\Models\Servicio;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class GenerarChecklist
{
    /**
     * Genera archivo Excel de checklist de un Servicio.
     ** USO DE LIBRERÍA CON LICENCIA GNU LGPL: https://phpspreadsheet.readthedocs.io/en/latest/
     * @param $servicio Servicio
     */
    public function downloadChecklist($servicio)
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
            $relator =new \stdClass();
            $relator->nombre="No Asignado";
            $relator->apellido="No Asignado";
        }

        $curso=$servicio->curso();

        $disenio_tecnico=$servicio->diseno_tecnico();
        if ($disenio_tecnico==null){
            $disenio_tecnico= new DisenoTecnico();
        }

        $check_sence=$servicio->check_sence();
        if ($check_sence==null){
            $check_sence= new CheckSence();
        }

        $check_cierre=$servicio->check_cierre();
        if ($check_cierre==null){
            $check_cierre= new CheckCierre();
        }

        $check_material_participante=$servicio->check_material_participante();
        if ($check_material_participante==null){
            $check_material_participante= new CheckMaterialParticipante();
        }

        $check_material_relator=$servicio->check_material_relator();
        if ($check_material_relator==null){
            $check_material_relator= new CheckMaterialRelator();
        }

        $check_audio_iluminacion=$servicio->check_audio_iluminacion();
        if ($check_audio_iluminacion==null){
            $check_audio_iluminacion= new CheckAudioIluminacion();
        }

        $check_coordinacion=$servicio->check_coordinacion();
        if ($check_coordinacion==null){
            $check_coordinacion= new CheckCoordinacion();
        }

        $check_outdoor=$servicio->check_outdoor();
        if ($check_outdoor==null){
            $check_outdoor= new CheckOutdoor();
        }



        //Crear CHECKLIST------------------------------------------------------------------------------------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: inline; filename=Checklist.xlsx");
        //header('Content-type: application/pdf');
        //header("Content-Disposition: inline; filename=Checklist.pdf");
        //Crear planilla
        $planilla= new Spreadsheet();
        $planilla->getProperties()->setTitle("Checklist");
        //obtener la hoja

        $planilla->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);//Setear fuente y tamaño
        $planilla->getDefaultStyle()->getFont()->setBold(true);
        $hoja=$planilla->getActiveSheet();
        $hoja->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LETTER);
        $hoja->getPageSetup()->setPrintArea('A1:L35');
        $hoja->getPageSetup()->setFitToWidth(1);
        $hoja->getPageSetup()->setFitToHeight(0);
        $hoja->setShowGridLines(false);

        $planilla->getActiveSheet()->getColumnDimension('A')->setWidth(11);
        $planilla->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('D')->setWidth(11);
        $planilla->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('G')->setWidth(11);
        $planilla->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('J')->setWidth(11);
        $planilla->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $planilla->getActiveSheet()->getColumnDimension('L')->setWidth(10);
        $hoja->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
        for($i=1;$i<=35; $i++){
            $hoja->getRowDimension($i)->setRowHeight(20);
        }
        $hoja->getStyle('A1:L35')->getAlignment()->setVertical('center');
        //Encabezado-----------------------------------------------------------------------------------------------------------
        $hoja->mergeCells('A1:I1');
        $hoja->setCellValue('A1',"LISTA CHEQUEO LIBERACIÓN DEL SERVICIO ADS CAPACITACIÓN");
        $hoja->mergeCells('J1:L1');
        $hoja->getStyle('J1:L1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $hoja->setCellValue('J1',"REV 08");
        //Cuadro general-------------------------------------------------------------------------------------------------------
        $hoja->getStyle('A2:L7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $hoja->getStyle('A2:L7')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);
        $hoja->getStyle('A2:L7')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK);
        $hoja->getStyle('A2:L7')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THICK);
        $hoja->getStyle('A2:L7')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THICK);
        $hoja->getStyle('A2:L7')->getFont()->setSize(8);
        $hoja->mergeCells('A2:I2');
        $hoja->setCellValue('A2',"SERVICIO: ".$servicio->nombre);
        $hoja->mergeCells('j2:L2');
        $hoja->setCellValue('J2',"CERT. ASISTENCIA: ".$servicio->certificado_sence);
        $hoja->mergeCells('A3:C3');
        $hoja->setCellValue('A3',"FECHA EJECUCIÓN: ".date("d-m-Y", strtotime($servicio->fecha_ejecucion)));
        $hoja->mergeCells('D3:L3');
        $hoja->setCellValue('D3',"RELATOR: ".$relator->nombre.' '.$relator->apellido);
        $hoja->mergeCells('A4:L4');
        $hoja->setCellValue('A4',"LUGAR DE REALIZACIÓN: ".$servicio->lugar_realizacion.", ".$ciudad);
        $hoja->mergeCells('A5:L5');
        $hoja->setCellValue('A5',"NOMBRE DEL CURSO: ".$curso->nombre_venta);
        $hoja->mergeCells('A6:F6');
        $hoja->setCellValue('A6',"ID DE ACCIÓN: ".$servicio->id_accion);
        $hoja->mergeCells('G6:L6');
        $hoja->setCellValue('G6',"CÓDIGO SENCE: ".$curso->codigo_sence);
        $hoja->getStyle('A7:L7')->getAlignment()->setWrapText(true);
        //$hoja->getRowDimension('7')->setRowHeight(25);
        $hoja->mergeCells('A7:C7');
        $hoja->setCellValue('A7',"HORARIO ACTIVIDAD: ".$servicio->horario);
        $hoja->mergeCells('D7:F7');
        $hoja->setCellValue('D7',"HORARIO COFFEE AM: ".$servicio->horario_coffee_am);
        $hoja->mergeCells('G7:I7');
        $hoja->setCellValue('G7',"HORARIO ALMUERZO: ".$servicio->horario_almuerzo);
        $hoja->mergeCells('J7:L7');
        $hoja->setCellValue('J7',"HORARIO COFFEE PM: ".$servicio->horario_coffee_pm);

        //centrar tickets
        $hoja->getStyle('E8:F35')->getAlignment()->setHorizontal('center');
        $hoja->getStyle('K8:L35')->getAlignment()->setHorizontal('center');
        $hoja->getStyle('A8:L35')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        //Diseño---------------------------------------------------------------------------------------------------------------
        $hoja->getStyle('A8:F8')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('A8:E8');
        $hoja->setCellValue('A8',"DISEÑO TÉCNICO");
        $hoja->getStyle('F8')->getFont()->setSize(5);
        $hoja->setCellValue('F8',"REALIZADO");
        $hoja->mergeCells('A9:E9');
        $hoja->getStyle('A9:E9')->getFont()->setBold(false);
        $hoja->setCellValue('A9',"Preparación diseño técnico");
        if($disenio_tecnico->diseno_tecnico_listo){
            $hoja->setCellValueByColumnAndRow(6,9,'✓');
        }

        //Logística------------------------------------------------------------------------------------------------------------
        $hoja->getStyle('A10:F10')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('A10:E10');
        $hoja->setCellValue('A10',"COORDINACIÓN");
        $hoja->getStyle('F10')->getFont()->setSize(5);
        $hoja->setCellValue('F10',"PREPARADO");
        $hoja->getStyle('A11:E14')->getFont()->setBold(false);
        $hoja->mergeCells('A11:E11');
        $hoja->setCellValue('A11',"Sala");
        if($check_coordinacion->coordinar_sala_listo){
            $hoja->setCellValueByColumnAndRow(6,11,'✓');
        }
        $hoja->mergeCells('A12:E12');
        $hoja->setCellValue('A12',"Coffee");
        if($check_coordinacion->coffee_aplica){
            if($check_coordinacion->coffee_listo){
                $hoja->setCellValueByColumnAndRow(6,12,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,12,'-');
        }
        $hoja->mergeCells('A13:E13');
        $hoja->setCellValue('A13',"Almuerzo");
        if($check_coordinacion->almuerzo_aplica){
            if($check_coordinacion->almuerzo_listo){
                $hoja->setCellValueByColumnAndRow(6,13,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,13,'-');
        }
        $hoja->mergeCells('A14:E14');
        $hoja->setCellValue('A14',"Nómina Participantes");
        if($check_coordinacion->nomina_participantes_listo){
            $hoja->setCellValueByColumnAndRow(6,14,'✓');
        }

        $hoja->getStyle('A15:F15')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('A15:D15');
        $hoja->setCellValue('A15',"SENCE");
        $hoja->getStyle('E15:F15')->getFont()->setSize(5);
        $hoja->setCellValue('E15',"PREPARADO");
        $hoja->setCellValue('F15',"RECEPCIONADO");
        $hoja->getStyle('A16:D18')->getFont()->setBold(false);
        $hoja->mergeCells('A16:D16');
        $hoja->setCellValue('A16',"ID Sence Cargado en Notebook");
        if($check_sence->sence_id_cargado_aplica){
            if($check_sence->sence_id_cargado_listo){
                $hoja->setCellValueByColumnAndRow(5,16,'✓');
            }
            $hoja->setCellValueByColumnAndRow(6,16,'-');
        }else{
            $hoja->setCellValueByColumnAndRow(5,16,'-');
            $hoja->setCellValueByColumnAndRow(6,16,'-');
        }
        $hoja->mergeCells('A17:D17');
        $hoja->setCellValue('A17',"Lector Biométrico");
        if($check_sence->verificar_lector_bio_aplica){
            if($check_sence->verificar_lector_bio_listo){
                $hoja->setCellValueByColumnAndRow(5,17,'✓');
            }
            if($check_sence->verificar_lector_bio_recepcion){
                $hoja->setCellValueByColumnAndRow(6,17,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,17,'-');
            $hoja->setCellValueByColumnAndRow(6,17,'-');
        }
        $hoja->mergeCells('A18:D18');
        $hoja->setCellValue('A18',"Reglamento Sence");
        if($check_sence->reglamento_sence_aplica){
            if($check_sence->reglamento_sence_listo){
                $hoja->setCellValueByColumnAndRow(5,18,'✓');
            }
            $hoja->setCellValueByColumnAndRow(6,18,'-');
        }else{
            $hoja->setCellValueByColumnAndRow(5,18,'-');
            $hoja->setCellValueByColumnAndRow(6,18,'-');
        }

        $hoja->getStyle('A19:F19')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('A19:D19');
        $hoja->setCellValue('A19',"MATERIAL RELATOR");
        $hoja->getStyle('E19:F19')->getFont()->setSize(5);
        $hoja->setCellValue('E19',"PREPARADO");
        $hoja->setCellValue('F19',"RECEPCIONADO");
        $hoja->getStyle('A20:D29')->getFont()->setBold(false);
        $hoja->mergeCells('A20:D20');
        $hoja->setCellValue('A20',"Libro asistencia");
        if($check_material_relator->libro_asistencia_listo){
            $hoja->setCellValueByColumnAndRow(5,20,'✓');
        }
        if($check_material_relator->libro_asistencia_recepcion){
            $hoja->setCellValueByColumnAndRow(6,20,'✓');
        }
        $hoja->mergeCells('A21:D21');
        $hoja->setCellValue('A21',"Pendones");
        if($check_material_relator->pendones_listo){
            $hoja->setCellValueByColumnAndRow(5,21,'✓');
        }
        if($check_material_relator->pendones_recepcion){
            $hoja->setCellValueByColumnAndRow(6,21,'✓');
        }
        $hoja->mergeCells('A22:D22');
        $hoja->setCellValue('A22',"Proyector");
        if($check_material_relator->proyector_aplica){
            if($check_material_relator->proyector_listo){
                $hoja->setCellValueByColumnAndRow(5,22,'✓');
            }
            if($check_material_relator->proyector_recepcion){
                $hoja->setCellValueByColumnAndRow(6,22,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,22,'-');
            $hoja->setCellValueByColumnAndRow(6,22,'-');
        }
        $hoja->mergeCells('A23:D23');
        $hoja->setCellValue('A23',"Notebook");
        if($check_material_relator->notebook_aplica){
            if($check_material_relator->notebook_listo){
                $hoja->setCellValueByColumnAndRow(5,23,'✓');
            }
            if($check_material_relator->notebook_recepcion){
                $hoja->setCellValueByColumnAndRow(6,23,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,23,'-');
            $hoja->setCellValueByColumnAndRow(6,23,'-');
        }
        $hoja->mergeCells('A24:D24');
        $hoja->setCellValue('A24',"Encuesta ADS");
        if($check_material_relator->encuesta_ads_listo){
            $hoja->setCellValueByColumnAndRow(5,24,'✓');
        }
        if($check_material_relator->encuesta_ads_recepcion){
            $hoja->setCellValueByColumnAndRow(6,24,'✓');
        }
        $hoja->mergeCells('A25:D25');
        $hoja->setCellValue('A25',"Encuesta Empresa");
        if($check_material_relator->encuesta_empresa_aplica){
            if($check_material_relator->encuesta_empresa_listo){
                $hoja->setCellValueByColumnAndRow(5,25,'✓');
            }
            if($check_material_relator->encuesta_empresa_recepcion){
                $hoja->setCellValueByColumnAndRow(6,25,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,25,'-');
            $hoja->setCellValueByColumnAndRow(6,25,'-');
        }
        $hoja->mergeCells('A26:D26');
        $hoja->setCellValue('A26',"Encuestas Adicionales");
        if($check_material_relator->encuesta_adicional_aplica){
            if($check_material_relator->encuesta_adicional_listo){
                $hoja->setCellValueByColumnAndRow(5,26,'✓');
            }
            if($check_material_relator->encuesta_adicional_recepcion){
                $hoja->setCellValueByColumnAndRow(6,26,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,26,'-');
            $hoja->setCellValueByColumnAndRow(6,26,'-');
        }
        $hoja->mergeCells('A27:D27');
        $hoja->setCellValue('A27',"Guías");
        if($check_material_relator->preparar_guia_aplica){
            if($check_material_relator->preparar_guia_listo){
                $hoja->setCellValueByColumnAndRow(5,27,'✓');
            }
            if($check_material_relator->preparar_guia_recepcion){
                $hoja->setCellValueByColumnAndRow(6,27,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,27,'-');
            $hoja->setCellValueByColumnAndRow(6,27,'-');
        }
        $hoja->mergeCells('A28:D28');
        $hoja->setCellValue('A28',"Pruebas");
        if($check_material_relator->preparar_prueba_aplica){
            if($check_material_relator->preparar_prueba_listo){
                $hoja->setCellValueByColumnAndRow(5,28,'✓');
            }
            if($check_material_relator->preparar_prueba_recepcion){
                $hoja->setCellValueByColumnAndRow(6,28,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,28,'-');
            $hoja->setCellValueByColumnAndRow(6,28,'-');
        }
        $hoja->mergeCells('A29:D29');
        $hoja->setCellValue('A29',"Plumones");
        if($check_material_relator->plumones_aplica){
            if($check_material_relator->plumones_listo){
                $hoja->setCellValueByColumnAndRow(5,29,'✓');
            }
            if($check_material_relator->plumones_recepcion){
                $hoja->setCellValueByColumnAndRow(6,29,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(5,29,'-');
            $hoja->setCellValueByColumnAndRow(6,29,'-');
        }

        $hoja->getStyle('A30:F30')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('A30:E30');
        $hoja->setCellValue('A30',"MATERIAL PARTICIPANTE");
        $hoja->getStyle('F30')->getFont()->setSize(5);
        $hoja->setCellValue('F30',"PREPARADO");
        $hoja->getStyle('A31:E35')->getFont()->setBold(false);
        $hoja->mergeCells('A31:E31');
        $hoja->setCellValue('A31',"Gafetes");
        if($check_material_participante->gafete_aplica){
            if($check_material_participante->gafete_listo){
                $hoja->setCellValueByColumnAndRow(6,31,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,31,'-');
        }
        $hoja->mergeCells('A32:E32');
        $hoja->setCellValue('A32',"Bitácora de aprendizaje");
        if($check_material_participante->bitacora_aplica){
            if($check_material_participante->bitacora_listo){
                $hoja->setCellValueByColumnAndRow(6,32,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,32,'-');
        }
        $hoja->mergeCells('A33:E33');
        $hoja->setCellValue('A33',"Carpeta ADS");
        if($check_material_participante->carpeta_ads_aplica){
            if($check_material_participante->carpeta_ads_listo){
                $hoja->setCellValueByColumnAndRow(6,33,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,33,'-');
        }
        $hoja->mergeCells('A34:E34');
        $hoja->setCellValue('A34',"VeloBind");
        if($check_material_participante->velobind_aplica){
            if($check_material_participante->velobind_listo){
                $hoja->setCellValueByColumnAndRow(6,34,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,34,'-');
        }
        $hoja->mergeCells('A35:E35');
        $hoja->setCellValue('A35',"Lápices");
        if($check_material_participante->lapices_aplica){
            if($check_material_participante->lapices_listo){
                $hoja->setCellValueByColumnAndRow(6,35,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(6,35,'-');
        }

        $hoja->getStyle('G8:L8')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('G8:J8');
        $hoja->setCellValue('G8',"AUDIO E ILUMINACIÓN");
        $hoja->getStyle('K8:L8')->getFont()->setSize(5);
        $hoja->setCellValue('K8',"PREPARADO");
        $hoja->setCellValue('L8',"RECEPCIONADO");
        $hoja->getStyle('G9:J14')->getFont()->setBold(false);
        $hoja->mergeCells('G9:J9');
        $hoja->setCellValue('G9',"Parlantes");
        if($check_audio_iluminacion->parlantes_aplica){
            if($check_audio_iluminacion->parlantes_listo){
                $hoja->setCellValueByColumnAndRow(11,9,'✓');
            }
            if($check_audio_iluminacion->parlantes_recepcion){
                $hoja->setCellValueByColumnAndRow(12,9,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,9,'-');
            $hoja->setCellValueByColumnAndRow(12,9,'-');
        }
        $hoja->mergeCells('G10:J10');
        $hoja->setCellValue('G10',"Atril");
        if($check_audio_iluminacion->atril_aplica){
            if($check_audio_iluminacion->atril_listo){
                $hoja->setCellValueByColumnAndRow(11,10,'✓');
            }
            if($check_audio_iluminacion->atril_recepcion){
                $hoja->setCellValueByColumnAndRow(12,10,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,10,'-');
            $hoja->setCellValueByColumnAndRow(12,10,'-');
        }
        $hoja->mergeCells('G11:J11');
        $hoja->setCellValue('G11',"Alargador");
        if($check_audio_iluminacion->alargador_aplica){
            if($check_audio_iluminacion->alargador_listo){
                $hoja->setCellValueByColumnAndRow(11,11,'✓');
            }
            if($check_audio_iluminacion->alargador_recepcion){
                $hoja->setCellValueByColumnAndRow(12,11,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,11,'-');
            $hoja->setCellValueByColumnAndRow(12,11,'-');
        }
        $hoja->mergeCells('G12:J12');
        $hoja->setCellValue('G12',"Foco");
        if($check_audio_iluminacion->foco_aplica){
            if($check_audio_iluminacion->foco_listo){
                $hoja->setCellValueByColumnAndRow(11,12,'✓');
            }
            if($check_audio_iluminacion->foco_recepcion){
                $hoja->setCellValueByColumnAndRow(12,12,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,12,'-');
            $hoja->setCellValueByColumnAndRow(12,12,'-');
        }
        $hoja->mergeCells('G13:J13');
        $hoja->setCellValue('G13',"Micrófono Cintillo");
        if($check_audio_iluminacion->microfono_cintillo_aplica){
            if($check_audio_iluminacion->microfono_cintillo_listo){
                $hoja->setCellValueByColumnAndRow(11,13,'✓');
            }
            if($check_audio_iluminacion->microfono_cintillo_recepcion){
                $hoja->setCellValueByColumnAndRow(12,13,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,13,'-');
            $hoja->setCellValueByColumnAndRow(12,13,'-');
        }
        $hoja->mergeCells('G14:J14');
        $hoja->setCellValue('G14',"Micrófono Inalámbrico");
        if($check_audio_iluminacion->microfono_inalambrico_aplica){
            if($check_audio_iluminacion->microfono_inalambrico_listo){
                $hoja->setCellValueByColumnAndRow(11,14,'✓');
            }
            if($check_audio_iluminacion->parlantes_inalambrico_recepcion){
                $hoja->setCellValueByColumnAndRow(12,14,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,14,'-');
            $hoja->setCellValueByColumnAndRow(12,14,'-');
        }

        $hoja->getStyle('G15:L15')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('G15:J15');
        $hoja->setCellValue('G15',"OUTDOOR");
        $hoja->getStyle('K15:L15')->getFont()->setSize(5);
        $hoja->setCellValue('K15',"PREPARADO");
        $hoja->setCellValue('L15',"RECEPCIONADO");
        $hoja->getStyle('G16:J28')->getFont()->setBold(false);
        $hoja->mergeCells('G16:J16');
        $hoja->setCellValue('G16',"Venda");
        if($check_outdoor->venda_aplica){
            if($check_outdoor->venda_listo){
                $hoja->setCellValueByColumnAndRow(11,16,'✓');
            }
            if($check_outdoor->venda_recepcion){
                $hoja->setCellValueByColumnAndRow(12,16,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,16,'-');
            $hoja->setCellValueByColumnAndRow(12,16,'-');
        }
        $hoja->mergeCells('G17:J17');
        $hoja->setCellValue('G17',"PVC");
        if($check_outdoor->pvc_aplica){
            if($check_outdoor->pvc_listo){
                $hoja->setCellValueByColumnAndRow(11,17,'✓');
            }
            if($check_outdoor->pvc_recepcion){
                $hoja->setCellValueByColumnAndRow(12,17,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,17,'-');
            $hoja->setCellValueByColumnAndRow(12,17,'-');
        }
        $hoja->mergeCells('G18:J18');
        $hoja->setCellValue('G18',"Pelota");
        if($check_outdoor->pelota_aplica){
            if($check_outdoor->pelota_listo){
                $hoja->setCellValueByColumnAndRow(11,18,'✓');
            }
            if($check_outdoor->pelota_recepcion){
                $hoja->setCellValueByColumnAndRow(12,18,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,18,'-');
            $hoja->setCellValueByColumnAndRow(12,18,'-');
        }
        $hoja->mergeCells('G19:J19');
        $hoja->setCellValue('G19',"Plumones");
        if($check_outdoor->plumones_aplica){
            if($check_outdoor->plumones_listo){
                $hoja->setCellValueByColumnAndRow(11,19,'✓');
            }
            if($check_outdoor->plumones_recepcion){
                $hoja->setCellValueByColumnAndRow(12,19,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,19,'-');
            $hoja->setCellValueByColumnAndRow(12,19,'-');
        }
        $hoja->mergeCells('G20:J20');
        $hoja->setCellValue('G20',"Papel Kraft");
        if($check_outdoor->papel_craf_aplica){
            if($check_outdoor->papel_craf_listo){
                $hoja->setCellValueByColumnAndRow(11,20,'✓');
            }
            if($check_outdoor->papel_craf_recepcion){
                $hoja->setCellValueByColumnAndRow(12,20,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,20,'-');
            $hoja->setCellValueByColumnAndRow(12,20,'-');
        }
        $hoja->mergeCells('G21:J21');
        $hoja->setCellValue('G21',"Pechera");
        if($check_outdoor->pechera_aplica){
            if($check_outdoor->pechera_listo){
                $hoja->setCellValueByColumnAndRow(11,21,'✓');
            }
            if($check_outdoor->pechera_recepcion){
                $hoja->setCellValueByColumnAndRow(12,21,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,21,'-');
            $hoja->setCellValueByColumnAndRow(12,21,'-');
        }
        $hoja->mergeCells('G22:J22');
        $hoja->setCellValue('G22',"Cinta Masking");
        if($check_outdoor->masquin_aplica){
            if($check_outdoor->masquin_listo){
                $hoja->setCellValueByColumnAndRow(11,22,'✓');
            }
            if($check_outdoor->masquin_recepcion){
                $hoja->setCellValueByColumnAndRow(12,22,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,22,'-');
            $hoja->setCellValueByColumnAndRow(12,22,'-');
        }
        $hoja->mergeCells('G23:J23');
        $hoja->setCellValue('G23',"Bolsa de Basura");
        if($check_outdoor->bolsa_basura_aplica){
            if($check_outdoor->bolsa_basura_listo){
                $hoja->setCellValueByColumnAndRow(11,23,'✓');
            }
            if($check_outdoor->bolsa_basura_recepcion){
                $hoja->setCellValueByColumnAndRow(12,23,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,23,'-');
            $hoja->setCellValueByColumnAndRow(12,23,'-');
        }
        $hoja->mergeCells('G24:J24');
        $hoja->setCellValue('G24',"Conos");
        if($check_outdoor->cono_aplica){
            if($check_outdoor->cono_listo){
                $hoja->setCellValueByColumnAndRow(11,24,'✓');
            }
            if($check_outdoor->cono_recepcion){
                $hoja->setCellValueByColumnAndRow(12,24,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,24,'-');
            $hoja->setCellValueByColumnAndRow(12,24,'-');
        }
        $hoja->mergeCells('G25:J25');
        $hoja->setCellValue('G25',"Platos");
        if($check_outdoor->plato_aplica){
            if($check_outdoor->plato_listo){
                $hoja->setCellValueByColumnAndRow(11,25,'✓');
            }
            if($check_outdoor->plato_recepcion){
                $hoja->setCellValueByColumnAndRow(12,25,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,25,'-');
            $hoja->setCellValueByColumnAndRow(12,25,'-');
        }
        $hoja->mergeCells('G26:J26');
        $hoja->setCellValue('G26',"Aro de Madera");
        if($check_outdoor->aro_madera_aplica){
            if($check_outdoor->aro_madera_listo){
                $hoja->setCellValueByColumnAndRow(11,26,'✓');
            }
            if($check_outdoor->aro_madera_recepcion){
                $hoja->setCellValueByColumnAndRow(12,26,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,26,'-');
            $hoja->setCellValueByColumnAndRow(12,26,'-');
        }
        $hoja->mergeCells('G27:J27');
        $hoja->setCellValue('G27',"Tijera");
        if($check_outdoor->tijera_aplica){
            if($check_outdoor->tijera_listo){
                $hoja->setCellValueByColumnAndRow(11,27,'✓');
            }
            if($check_outdoor->tijera_recepcion){
                $hoja->setCellValueByColumnAndRow(12,27,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,27,'-');
            $hoja->setCellValueByColumnAndRow(12,27,'-');
        }
        $hoja->mergeCells('G28:J28');
        $hoja->setCellValue('G28',"Esquí");
        if($check_outdoor->esqui_aplica){
            if($check_outdoor->esqui_listo){
                $hoja->setCellValueByColumnAndRow(11,28,'✓');
            }
            if($check_outdoor->esqui_recepcion){
                $hoja->setCellValueByColumnAndRow(12,28,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(11,28,'-');
            $hoja->setCellValueByColumnAndRow(12,28,'-');
        }

        //Cierre---------------------------------------------------------------------------------------------------------------
        $hoja->getStyle('G29:L29')->getFill() ->setFillType(Fill::FILL_SOLID) ->getStartColor()->setARGB('DBDBDB');
        $hoja->mergeCells('G29:K29');
        $hoja->setCellValue('G29',"CIERRE DEL CURSO");
        $hoja->getStyle('L29')->getFont()->setSize(5);
        $hoja->setCellValue('L29',"REALIZADO");
        $hoja->getStyle('G30:K35')->getFont()->setBold(false);
        $hoja->mergeCells('G30:K30');
        $hoja->setCellValue('G30',"Diplomas Curso");
        if($check_cierre->diplomas_aplica){
            if($check_cierre->diplomas_listo){
                $hoja->setCellValueByColumnAndRow(12,30,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(12,30,'-');
        }
        $hoja->mergeCells('G31:K31');
        $hoja->setCellValue('G31',"Notas");
        if($disenio_tecnico->prueba_aplica || $disenio_tecnico->guia_aplica){
            if($check_cierre->notas_listo){
                $hoja->setCellValueByColumnAndRow(12,31,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(12,31,'-');
        }

        $hoja->mergeCells('G32:K32');
        $hoja->setCellValue('G32',"Certificado Sence");
        if($check_cierre->certificado_sence_aplica){
            if($check_cierre->certificado_sence_listo){
                $hoja->setCellValueByColumnAndRow(12,32,'✓');
            }
        }else{
            $hoja->setCellValueByColumnAndRow(12,32,'-');
        }
        $hoja->mergeCells('G33:K33');
        $hoja->setCellValue('G33',"Libro de Asistencia");
        if($check_cierre->libro_asistencia_listo){
            $hoja->setCellValueByColumnAndRow(12,33,'✓');
        }
        $hoja->mergeCells('G34:K34');
        $hoja->setCellValue('G34',"Encuesta ADS");
        if($check_cierre->resultado_encuestas_ads_listo){
            $hoja->setCellValueByColumnAndRow(12,34,'✓');
        }
        $hoja->mergeCells('G35:K35');


        $escritor= IOFactory::createWriter($planilla,'Xlsx');
        //$escritor= IOFactory::createWriter($planilla,'Tcpdf');
        $escritor->save('php://output');
    }

}