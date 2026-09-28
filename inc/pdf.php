<?php 
    require("fpdf.php");

    class PDF extends FPDF
    {

        function Header(){
            $this-> setFont('Arial', 'B', 20);
            $this->SetFillColor(0,153,153);
            $this->Cell(190, 15, "Super Lista", 1,0,'C', true);

            $this->Ln(20);
        }

        function Footer(){
            $this-> SetY(-15);

            $this->SetFont('Arial','I',8);
            
            $this->Cell(0,10, converteTexto('Página ') . $this-> PageNo() . ' de {nb}', 0,0, 'C');
        }

    }

    function converteTexto($str) {
        $str = iconv('UTF-8', 'windows-1252', $str);
        return $str;
    }
?>