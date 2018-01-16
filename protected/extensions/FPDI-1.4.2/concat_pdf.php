<?php

include 'protected/extensions/fpdf17/fpdf.php';
include 'protected/extensions/FPDI-1.4.2/fpdi.php';


    session_start();

    // Turn up error reporting
    error_reporting (E_ALL|E_STRICT);

    ob_start(  );

       // creo la clase para concatenación de PDFS
    class concat_pdf extends FPDI {

        var $files = array();

        function setFiles($files) {
            $this->files = $files;
        }

        function concat() {
            foreach($this->files AS $file) {
                $pagecount = $this->setSourceFile($file);
                for ($i = 1; $i <= $pagecount; $i++) {
                     $tplidx = $this->ImportPage($i);
                     $s = $this->getTemplatesize($tplidx);
                     $this->AddPage('P', array($s['w'], $s['h']));
                     $this->useTemplate($tplidx);
                }
            }
        }
    }

?>
