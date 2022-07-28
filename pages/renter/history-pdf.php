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
       
        $this->Cell(35,10,'Vehicle Model',1,0,'C');
        $this->Cell(27,10,'Vehicle Brand',1,0,'C');
        $this->Cell(40,10,'Vehicle Owner',1,0,'C');
        $this->Cell(30,10,'Booking Date',1,0,'C');
        $this->Cell(30,10,'Return Date',1,0,'C');
        $this->Cell(30,10,'Purpose',1,0,'C');
        $this->Cell(27,10,'Manpower',1,0,'C');
        $this->Cell(30,10,'Penalty',1,0,'C');
        $this->Cell(35,10,'Total Payment',1,0,'C');
        $this->Ln();
    }
    function viewTable($dbh){
        $this->SetFont('Times','',12);

        $id = $_SESSION['userid'];
        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT * FROM bookinghistory
        INNER JOIN vehicle ON bookinghistory.vehicleid = vehicle.vehicleid
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid
        INNER JOIN ownercredentials ON vehicle.userid = ownercredentials.ownerid
        INNER JOIN user ON ownercredentials.ownerid = user.userid
        WHERE bookinghistory.renterid = $id";
        $query=$dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchALL(PDO::FETCH_OBJ);
        if ($query->rowCount()>0) {
        foreach ($results as $result) 
        {
        $this->Cell(35,15,$result->model,1,0,'L');
        $this->Cell(27,15,$result->brand,1,0,'L');
        $this->Cell(40,15,$result->firstname.' '.$result->lastname,1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->bookingdate)),1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->returndate)),1,0,'L');
        $this->Cell(30,15,$result->purpose,1,0,'L');
        $this->Cell(27,15,$result->manpower,1,0,'L');
        if($result->penalty > 0)
        {
        $this->Cell(30,15,number_format((float)$result->penalty , 2, '.', ',').''.' Pesos',1,0,'L');
        }
        else
        {
        $this->Cell(30,15,'No Penalty',1,0,'L');
        }
        $this->Cell(35,15,number_format((float)$result->total, 2, '.', ',').''.' Pesos',1,0,'L');
       
        $this->Ln();
        }
    }
    else
    {
        $this->Cell(284,10,'No Data Available',1,1,'C');
    }
    }
    else
    {
        $sql= "SELECT * FROM bookinghistory
        INNER JOIN vehicle ON bookinghistory.vehicleid = vehicle.vehicleid
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid
        INNER JOIN ownercredentials ON vehicle.userid = ownercredentials.ownerid
        INNER JOIN user ON ownercredentials.ownerid = user.userid
        WHERE bookinghistory.renterid = $id AND MONTH(bookinghistory.date) =  $month";
        $query=$dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchALL(PDO::FETCH_OBJ);
        if ($query->rowCount()>0) {
        foreach ($results as $result) 
        {
        $this->Cell(35,15,$result->model,1,0,'L');
        $this->Cell(27,15,$result->brand,1,0,'L');
        $this->Cell(40,15,$result->firstname.' '.$result->lastname,1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->bookingdate)),1,0,'L');
        $this->Cell(30,15,date("F d, Y", strtotime($result->returndate)),1,0,'L');
        $this->Cell(30,15,$result->purpose,1,0,'L');
        $this->Cell(27,15,$result->manpower,1,0,'L');
        if($result->penalty > 0)
        {
        $this->Cell(30,15,number_format((float)$result->penalty , 2, '.', ',').''.' Pesos',1,0,'L');
        }
        else
        {
        $this->Cell(30,15,'No Penalty',1,0,'L');
        }
        $this->Cell(35,15,number_format((float)$result->total, 2, '.', ',').''.' Pesos',1,0,'L');
       
        $this->Ln();
        }
        }   
        else
        {
            $this->Cell(284,10,'No Data Available',1,1,'C');
        }
    }     
    }
    function Total($dbh) {
        

        $id = $_SESSION['userid'];
        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT SUM(booking.total) AS totalpayment FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid WHERE
        bookinghistory.renterid = $id";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                
                   foreach ($results as $result) 
                   {
                if ($result->totalpayment > 0) 
                {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total:',1,0,'C'); 
                 $this->Cell(249,10,number_format((float)$result->totalpayment, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
            }
        }
        else
        {
            $sql= "SELECT SUM(booking.total) AS totalpayment FROM bookinghistory 
            INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid WHERE
            bookinghistory.renterid = $id AND MONTH(bookinghistory.date) =  $month";
                     $query=$dbh->prepare($sql);
                     $query->execute();
                     $results=$query->fetchALL(PDO::FETCH_OBJ);
                     foreach ($results as $result) 
                     if ($result->totalpayment > 0) 
                     {
                    
                     $this->SetFont('Times','B',12);
                     $this->Cell(35,10, 'Total:',1,0,'C'); 
                     $this->Cell(249,10,number_format((float)$result->totalpayment, 2, '.', ',').''.' Pesos',1,1,'L');
                     
                     }
                     else
                     {
                  
                     }
        }
    }
    function Penalty($dbh) {
        

        $id = $_SESSION['userid'];
        $month = $_GET['month'];
        if($month == 'All')
        {
        $sql= "SELECT SUM(booking.penalty) AS totalpenalty FROM bookinghistory 
        INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid WHERE
        bookinghistory.renterid = $id";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                
                   foreach ($results as $result) 
                   {
                if ($result->totalpenalty > 0) 
                {
                 $this->SetFont('Times','B',12);
                 $this->Cell(35,10, 'Total Penalty:',1,0,'C'); 
                 $this->Cell(249,10,number_format((float)$result->totalpenalty, 2, '.', ',').''.' Pesos',1,1,'L');
                }
                else
                {

                }
            }
        }
        else
        {
            $sql= "SELECT SUM(booking.penalty) AS totalpenalty FROM bookinghistory 
            INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid WHERE
            bookinghistory.renterid = $id AND MONTH(bookinghistory.date) =  $month";
                     $query=$dbh->prepare($sql);
                     $query->execute();
                     $results=$query->fetchALL(PDO::FETCH_OBJ);
                     foreach ($results as $result) 
                     if ($result->totalpenalty > 0) 
                     {
                    
                     $this->SetFont('Times','B',12);
                     $this->Cell(35,10, 'Total Penalty:',1,0,'C'); 
                     $this->Cell(249,10,number_format((float)$result->totalpenalty, 2, '.', ',').''.' Pesos',1,1,'L');
                     
                     }
                     else
                     {
                  
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