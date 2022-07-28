<?php 

require('fpdf1.php');
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');  
session_start();

class myPDF extends FPDF{
    function header (){
        $this->Image('../../dist/img/logo.png',10,5,28);
        $this->SetFont('Arial','B',16);
        $this->Cell(276,25,'Vehicles List',0,0,'C');
        $this->Ln();
        
       
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');

    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(35,10,'Vehicle Owner',1,0,'C');
        $this->Cell(40,10,'Model',1,0,'C');
        $this->Cell(25,10,'Brand',1,0,'C');
        $this->Cell(25,10,'Color',1,0,'C');
        $this->Cell(30,10,'Vehicle Type',1,0,'C');
        $this->Cell(20,10,'Capacity',1,0,'C');
        $this->Cell(25,10,'Plate No.',1,0,'C');
        $this->Cell(25,10,'OR',1,0,'C');
        $this->Cell(25,10,'CR.',1,0,'C');
        $this->Cell(27,10,'Rate per day',1,0,'C');
        $this->Ln();
    }
    function viewTable($dbh){
        
        $this->SetFont('Times','',12);
        $sql="SELECT * FROM user INNER JOIN vehicle ON vehicle.userid=user.userid";
        $query=$dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchALL(PDO::FETCH_OBJ);
        foreach ($results as $result) 
        {
        $cellWidth=25;
	    while($this->GetStringWidth($result->brand) > $cellWidth){ //loop until the string width is smaller than cell width
            $this->SetFontSize($tempFontSize -= 0.1);
	    }
        $this->Cell(35,15,$result->firstname.' '.$result->lastname,1,0,'L');
        $this->Cell(40,15,$result->model,1,0,'L');
        $this->Cell($cellWidth,15,$result->brand,1,0,'L');
        $this->Cell(25,15,$result->color,1,0,'L');
        $this->Cell(30,15,$result->vehicletype,1,0,'L');
        $this->Cell(20,15,$result->capacity,1,0,'L');
        $this->Cell(25,15,$result->platenumber,1,0,'L');
        $this->Cell(25,15,$result->officialreceipt,1,0,'L');
        $this->Cell(25,15,$result->certofregistration,1,0,'L');
        $this->Cell(27,15,number_format((float)$result->rate, 2, '.', ',').''.' Pesos',1,0,'L');
        $this->Ln();
        }     
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($dbh);
$pdf->Output();


?>