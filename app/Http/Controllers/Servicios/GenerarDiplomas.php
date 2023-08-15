<?php


namespace App\Http\Controllers\Servicios;


use App\Models\PDF;

class GenerarDiplomas
{
    /**
     *
     * Genera un pdf con varios diplomas de Participantes.
     *
     *USO DE LIBRERÍA GRATUITA www.fpdf.org/
     *
     * @param  int  $id del Servicio
     * @return \Illuminate\Http\Response
     */
    public function downloadDiploma($fecha,$participantes,$tipoFondoDiploma,$fondoSiNo,$programaCurso,$leyenda,$tallerPrograma)
    {
        header('Content-type: application/pdf');
        //Definir tipo diploma
        if($tipoFondoDiploma==1){
            $orientacion='P';
            $fondo='fondo_diploma_aves.jpg';
            $xFondo=10;
            $yFondo=13;
            $wFondo=195.9;
            $hFondo=253.4;
            $hDirigido=null;
            $hNombre=180;
            $setYTexto=120;
            $setXTexto=30;
            $wTexto=155;
            $rojo=74;//colores rgb
            $verde=74;
            $azul=72;
        }
        if($tipoFondoDiploma==2){
            $orientacion='P';
            $fondo='fondo_diploma_piedras.jpg';
            $xFondo=10;
            $yFondo=13;
            $wFondo=195.9;
            $hFondo=253.4;
            $hDirigido=null;
            $hNombre=200;
            $setYTexto=130;
            $setXTexto=30;
            $wTexto=155;
            $rojo=74;//colores rgb
            $verde=74;
            $azul=72;
        }
        if($tipoFondoDiploma==3){
            $orientacion='L';
            $fondo='fondo_diploma_horizontal.jpg';
            $xFondo=13;
            $yFondo=10;
            $wFondo=253.4;
            $hFondo=195.9;
            $hDirigido=130;
            $hNombre=-100;
            $setYTexto=110;
            $setXTexto=45;
            $wTexto=190;
            $rojo=74;//colores rgb
            $verde=74;
            $azul=72;
        }

        // PDF tamaño carta, es de 215.9 mm x 279.4 mm
        $pdf = new PDF($orientacion,'mm','Letter');
        $pdf->SetTitle("Diplomas Servicios");
        //Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(10, 13 , 10);
        #Establecemos el margen inferior:
        $pdf->SetAutoPageBreak(true,13);

        foreach ($participantes as $participante) {
            if($participante["estado"]!="Reprobación"){
                //Añadir página
                $pdf->AddPage();

                //Setear fuente a usar
                $pdf->AddFont('avenir','B','Avenir-Book.php');
                $pdf->SetFont('avenir','B',20);

                //tamaño carta es de 215.9 mm x 279.4 mm
                if($fondoSiNo==true){
                    $pdf->Image(storage_path().'/app/public/imagenes/'.$fondo,$xFondo,$yFondo,$wFondo,$hFondo);
                }
                //si va el dirigido
                if ($hDirigido!=null){
                    $pdf->AddFont('avenir','','Avenir-Book.php');
                    $pdf->SetFont('avenir','',14);
                    //$dirigido='Se acredita al Sr. (a)';
                    $dirigido='';
                    $dirigido = iconv('UTF-8', 'windows-1252', $dirigido);//Convertir símbolos
                    $pdf->cell(0,$hDirigido,$dirigido,0,1,'C');
                }

                //Colocar nombre del participante
                $pdf->AddFont('avenir-black','B','Avenir_95_Black.php');
                $pdf->SetFont('avenir-black','B',20);
                $pdf->SetTextColor($rojo,$verde,$azul);
                $nombre=$participante["nombre"];
                $nombre = iconv('UTF-8', 'windows-1252', $nombre);//Convertir símbolos
                $pdf->cell(0,$hNombre,$nombre,0,2,'C');

                //Colocar texto del diploma
                $pdf->SetXY($setXTexto,$setYTexto);
                $pdf->AddFont('avenir','B','Avenir-Book.php');
                $pdf->SetFont('avenir','B',14);
                $inicio='Por su ';
                $impartido=', impartido por ';
                $ads='"ADS Consultores" ';
                $texto=$inicio.$participante["estado"].' en el '.' '.$tallerPrograma.' '.$programaCurso.$impartido.$ads.' '.$fecha;
                $textoCompleto=$texto.' '.$leyenda;
                $textoCompleto = iconv('UTF-8', 'windows-1252',$textoCompleto);//Convertir símbolos
                $pdf->MultiCell($wTexto,7,$textoCompleto,0,'C',false);
            }
        }
        $pdf->Close();
        $pdf->Output('F',storage_path().'/app/public/documentos/diplomas/Diplomas Servicios.pdf',false);
    }

}