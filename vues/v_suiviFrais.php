<table class="liste">
  	   <caption>Les Fiches 
       </caption>
             <tr>
                 
                <th class="visiteur">Visiteur</th> 
                 <th class="mois">Mois</th> 
                   <th class="montant">Montant Valide</th> 
                <th class="date">Date Modification</th>
		<th class="etat">Etat</th>             
                <th class="action">Valider</th>      
                <th class="action">Telecharger</th>  
             </tr>
             
             
      <form method="POST"  action="index.php?uc=suivrePaiement&action=Payer">
      <div class="corpsForm">
          
          <fieldset>
                 
          
    <?php    
    
   
	    foreach( $lesFiches as $uneFiche) 
		{
			$visiteur = $uneFiche['idVisiteur'] ;
            $mois     = $uneFiche['mois'] ;
            $nbJustificatifs = $uneFiche['nbJustificatifs'];
			$montantValide = $uneFiche['montantValide'];
			$dateModif = $uneFiche['dateModif'];
            $idEtat = $uneFiche['idEtat'];
	?>		
            <tr>
                <td> <?php echo $visiteur ?></td>
                <td><?php echo $mois ?></td>
                <td><?php echo $montantValide ?></td>
                <td><?php echo $idEtat ?></td>
                 <td><?php echo $dateModif ?></td>
                
           <td> <input type="checkbox" name="rb[]" value=<?php echo $visiteur.";".$mois.";".$idEtat ?> />
<td><a href = index.php?uc=pdfAjout&action=pdfAjout&visiteur=<?php echo $visiteur ?>&mois=<?php echo $mois ?>> <img src = 'images/pdf.png' border = '0'></a></td>

                
             </tr>
	<?php		 
          
          }
	?>
       </fieldset>
      </div>
       <input id="ok" type="submit" value="Valider" size="20" />
             </form>
                                          
    </table>
    