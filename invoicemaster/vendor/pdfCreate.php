<?php

require_once __DIR__ . '/autoload.php';
$footer = array();
ob_start();
include( "pdf_format.php");
$html[0] = ob_get_clean();
ob_end_flush();
function downloadPDF($invoice ,$html, $margin = 0, $mode = 'F') {
    $mpdf = new \Mpdf\Mpdf();
    foreach ($html as $key => $content) {
        if ($key > 0) {
            $mpdf->AddPage();
        }
        $mpdf->WriteHTML($content);
    }
        return $mpdf->Output($invoice, $mode);
   
}