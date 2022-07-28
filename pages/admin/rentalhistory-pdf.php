<?php 

require('../../fpdf/fpdf.php');
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');  
session_start();

class myPDF extends FPDF{
    function header (){
        $this->Image('../../dist/img/logo.png',10,5,28);
        $this->SetFont('Arial','B',16);
        $this->Cell(276,25,'Rental History',0,0,'C');
        $this->Ln();
        
       
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');

    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(35,10,'Model',1,0,'C');
        $this->Cell(30,10,'Brand',1,0,'C');
        $this->Cell(35,10,'Client',1,0,'C');
        $this->Cell(30,10,'Booking Date',1,0,'C');
        $this->Cell(30,10,'Return Date',1,0,'C');
        $this->Cell(33,10,'Purpose',1,0,'C');
        $this->Cell(30,10,'Manpower',1,0,'C');
        $this->Cell(30,10,'Penalty',1,0,'C');
        $this->Cell(30,10,'Total Payment',1,0,'C');
        
        $this->Ln();
    }
    function viewTable($dbh){
        $this->SetFont('Times','',12);

        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT * FROM bookinghistory
        INNER JOIN vehicle ON bookinghistory.vehicleid = vehicle.vehicleid
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid
        INNER JOIN user ON booking.renterid = user.userid";
        $query=$dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchALL(PDO::FETCH_OBJ);
        if ($query->rowCount()>0)
         {
        foreach ($results as $result) 
        {
       
        $this->Cell(35,15,$result->model,1,0,'L');
        $this->Cell(30,15,$result->brand,1,0,'L');
        $this->Cell(35,15,$result->firstname.' '.$result->lastname,1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->bookingdate)),1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->returndate)),1,0,'L');
        $this->Cell(33,15,$result->purpose,1,0,'L');
        $this->Cell(30,15,$result->manpower,1,0,'L');
        if($result->penalty > 0)
        {
        $this->Cell(30,15,number_format((float)$result->penalty, 2, '.', ',').''.' Pesos',1,0,'L');
        }
        else
        {
        $this->Cell(30,15,'No Penalty',1,0,'L');
        }
        $this->Cell(30,15,number_format((float)$result->total, 2, '.', ',').''.' Pesos',1,0,'L');
        
        $this->Ln();
        
        } 
    }
    else
    {
        $this->Cell(283,10,'No Data Available',1,1,'C');
    }
    }
    else
    {
        $sql= "SELECT * FROM bookinghistory
        INNER JOIN vehicle ON bookinghistory.vehicleid = vehicle.vehicleid
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid
        INNER JOIN user ON booking.renterid = user.userid AND MONTH(bookinghistory.date) =  $month";
        $query=$dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchALL(PDO::FETCH_OBJ);
        if ($query->rowCount()>0)
         {
        foreach ($results as $result) 
        {
       
        $this->Cell(35,15,$result->model,1,0,'L');
        $this->Cell(30,15,$result->brand,1,0,'L');
        $this->Cell(35,15,$result->firstname.' '.$result->lastname,1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->bookingdate)),1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->returndate)),1,0,'L');
        $this->Cell(33,15,$result->purpose,1,0,'L');
        $this->Cell(30,15,$result->manpower,1,0,'L');
        if($result->penalty > 0)
        {
        $this->Cell(30,15,number_format((float)$result->penalty, 2, '.', ',').''.' Pesos',1,0,'L');
        }
        else
        {
        $this->Cell(30,15,'No Penalty',1,0,'L');
        }
        $this->Cell(30,15,number_format((float)$result->total, 2, '.', ',').''.' Pesos',1,0,'L');
        
        $this->Ln();
        
        } 
    }
    else
    {
        $this->Cell(283,10,'No Data Available',1,1,'C');
    }
    }   
    }

    function Total($dbh) 
    {
        
        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT SUM(booking.total) AS totalpayment FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                   foreach ($results as $result) 
                   {
                    if ($result->totalpayment > 0) 
                    {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total:',1,0,'C'); 
                 $this->Cell(248,10,number_format((float)$result->totalpayment, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
             }
     }
    else
    {
        $sql= "SELECT SUM(booking.total) AS totalpayment FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid AND MONTH(bookinghistory.date) =  $month";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                   foreach ($results as $result) 
                   {
                    if ($result->totalpayment > 0) 
                    {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total:',1,0,'C'); 
                 $this->Cell(248,10,number_format((float)$result->totalpayment, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
             }
    }
}
function Penalty($dbh) 
    {
        
        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT SUM(booking.penalty) AS totalpenalty FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                   foreach ($results as $result) 
                   {
                    if ($result->totalpenalty > 0) 
                    {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total Penalty:',1,0,'C'); 
                 $this->Cell(248,10,number_format((float)$result->totalpenalty, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
             }
     }
    else
    {
        $sql= "SELECT SUM(booking.penalty) AS totalpenalty FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid AND MONTH(bookinghistory.date) =  $month";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                   foreach ($results as $result) 
                   {
                    if ($result->totalpenalty > 0) 
                    {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total Penalty:',1,0,'C'); 
                 $this->Cell(248,10,number_format((float)$result->totalpenalty, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
             }
    }
}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($dbh);
$pdf->Total($dbh);
$pdf->Penalty($dbh);
$pdf->Output();


?>