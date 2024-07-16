<?php

require('./fpdf.php');

require "./config.php";

$pdf=new FPDF("P","mm","letter");
$pdf->AddPage();
$pdf->SetFont("Arial","B","12");
$pdf->Cell(100,5,"jajajaj",1,0,"C");
$pdf->Output();