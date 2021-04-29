<?php





    

    
 
require(dirname(__FILE__) . '/../fpdf/fpdf.php');

  $idVisiteur = $_REQUEST['visiteur']; 
     $leMois = $_REQUEST['mois'];  
            
    
      
       $leVisiteur = $pdo->getInfosVisiteur($idVisiteur) ; 
       
       

    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->Image(dirname(__FILE__) . '/../images/logo.jpg',10,10, 64, 48);
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(60,20,'Fiche de Frais  ');

    
    $header1 = array('Frais Forfaitaires','Quantite','Montant unitaire','Total');
   $header2 = array('Date','Libell�','Montant');
    
    
    $pdf->SetFont('Arial','B',15);
    $pdf->Ln(30);
    $pdf->Cell(40,10,'Visiteur :' .$idVisiteur." ".$idVisiteur);
    $pdf->Ln(10);
    $pdf->Cell(40,10,'Mois :' .$leMois);
    $pdf->Ln(10);
    

     $pdf->SetFont('Arial','',15);
  
     $pdf->Cell(60,11,$header1[0],1);
    $pdf->Cell(40,11,$header1[1],1);
     $pdf->Cell(40,11,$header1[2],1);
      $pdf->Cell(40,11,$header1[3],1);
    $pdf->Ln();

      
    $pdf->Output();
    
    
    
    
 
    
    
?>