<?php






require(dirname(__FILE__) . '/../fpdf/fpdf.php');
    ob_start();
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->Image(dirname(__FILE__) . '/../images/logo.jpg',10,10, 64, 48);
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(60,20,'Fiche de Frais  ');
   $tab1 = array('Frais Forfaitaires','Quantite','Montant unitaire','Total');
   $tab2 = array('Date','Libelle','Montant');
    
    
    $pdf->SetFont('Arial','B',15);
    $pdf->Ln(30);
    $pdf->Cell(40,10,'Visiteur :' .$visiteur['nom']." ".$visiteur['prenom']);
    $pdf->Ln(10);
    $pdf->Cell(40,10,'Mois :' .$mois);
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',15);
  
     $pdf->Cell(60,7,$tab1[0],1);
    $pdf->Cell(40,7,$tab1[1],1);
     $pdf->Cell(40,7,$tab1[2],1);
      $pdf->Cell(40,7,$tab1[3],1);
    $pdf->Ln();
	$totaldefraits = 0;
    foreach($lesFraisForfait as $row)
    {
            $pdf->Cell(60,6,  utf8_decode($row['libelle']),1);
            $pdf->Cell(40,6,$row['quantite'],1);
            $pdf->Cell(40,6,$row['montant'],1);
            $pdf->Cell(40,6,$row['montant']*$row['quantite'],1);
            $totaldefraits += $row['montant']*$row['quantite'] ;
        $pdf->Ln();
    }
    $pdf->SetFont('Arial','B',15);
    $pdf->Ln(20);
    $pdf->Cell(40,10,'Les frais supplementaires ');
    $pdf->Ln(20);
     $pdf->SetFont('Arial','',15);
    $pdf->Cell(30,7,$tab2[0],1);
    $pdf->Cell(100,7,$tab2[1],1);
     $pdf->Cell(30,7,$tab2[2],1);
      $pdf->Ln();
     $totaldesfraitshorsforfait =0;  
      foreach($lesFraisHorsForfait as $row)
    {
            $pdf->Cell(30,6,$row['date'],1);
            $pdf->Cell(100,6,utf8_decode($row['libelle']),1);
            $pdf->Cell(30,6,$row['montant'],1);
      $totaldesfraitshorsforfait += $row['montant'] ;       
        $pdf->Ln();
    }
    $total = $totaldefraits+$totaldesfraitshorsforfait ;
    $refuse = $totaldefraits+$totaldesfraitshorsforfait - $montantValide ;
    $pdf->Cell(60,10,'Toto :' );
     $pdf->Cell(60,10,$total);
    $pdf->Ln(10);
   $pdf->Cell(60,10,'Montant Refuse :' ." ");
     $pdf->Cell(60,10,$refuse);
    $pdf->Ln(10); 
    $pdf->Cell(60,10,'Montant Valide :' ." ");
     $pdf->Cell(60,10,$montantValide);
    $pdf->AddPage();
    $pdf->Ln(10); 
    $pdf->Output();
    ob_end_flush();
    
    
    
 
    
    
?>