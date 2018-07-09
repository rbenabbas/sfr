<?php



include('Bd_Connect.php');
mysql_query("TRUNCATE TABLE livraison");
mysql_query("TRUNCATE TABLE chequier");

//On vide la TABLE
//mysql_query("TRUNCATE TABLE dmd");

$dirname = './fichiers_retour';
$dir = opendir($dirname); 
/** lires plusiers fichiers dans le dossier fichiers */
while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))
	{
	 /* On ouvre le fichier à importer en lecture seulement 
       $file une variable contient le nom de fichier a importé 
         */
  
     $fp=fopen("fichiers_retour/".$file,"r");
 
 
    if (!feof($fp)) /* on importe */
    { /* Tant qu'on n'atteint pas la fin du fichier */ 
       $ligne = fgetss($fp,4096); /* On lit une ligne */  
	   //$idf=$ligne;
	   $n_bon_livraison = rtrim(substr($ligne,0,11));	
	   $date_livraison = rtrim(substr($ligne,10,8));
	   $num_commande = rtrim(substr($ligne,18,10));
	   $date_commande = rtrim(substr($ligne,28,8));
	   $date_production = rtrim(substr($ligne,36,8));
	   $nbr_total_t1 = rtrim(substr($ligne,44,4));
	   $serie1_t1 = rtrim(substr($ligne,48,2));
	   $n°_debut_serie1_t1 = rtrim(substr($ligne,50,7));
	   $n°_fin_serie1_t1 = rtrim(substr($ligne,57,7));
	   $serie2_t1 = rtrim(substr($ligne,66,2));
	   $n°_debut_serie2_t1 = rtrim(substr($ligne,68,7));
	   $n°_fin_serie2_t1 = rtrim(substr($ligne,70,7));
	   $nbr_t2 = rtrim(substr($ligne,82,2));
	   $serie1_t2 = rtrim(substr($ligne,84,2));
	   $n°_debut_serie1_t2 = rtrim(substr($ligne,86,7));
	   $n°_fin_serie1_t2 = rtrim(substr($ligne,93,7));
	   $serie2_t2 = rtrim(substr($ligne,102,2));
	   $n°_debut_serie2_t2 = rtrim(substr($ligne,104,7));
	   $n°_fin_serie2_t2 = rtrim(substr($ligne,111,7));
	   $nbr_t3 = rtrim(substr($ligne,120,4));
	   $serie1_t3 = rtrim(substr($ligne,124,2));
	   $n°_debut_serie1_t3 = rtrim(substr($ligne,126,7));
	   $n°_fin_serie1_t3 = rtrim(substr($ligne,134,7));
	   $serie2_t3 = rtrim(substr($ligne,141,2));
	   $n°_debut_serie2_t3 = rtrim(substr($ligne,143,7));
	   $n°_fin_serie2_t3 = rtrim(substr($ligne,150,7));
	    /* Ajouter un nouvel enregistrement dans la table */ 
       $query = "INSERT INTO livraison VALUES('$n_bon_livraison','$date_livraison','$num_commande','$date_commande','$date_production','$nbr_total_t1',
	   '$serie1_t1','$n°_debut_serie1_t1','$n°_fin_serie1_t1','$serie2_t1','$n°_debut_serie2_t1','$n°_fin_serie2_t1','$nbr_t2'
	   ,'$serie1_t2','$n°_debut_serie1_t2','$n°_fin_serie1_t2','$serie2_t2','$n°_debut_serie2_t2','$n°_fin_serie2_t2'
	   ,'$nbr_t3','$serie1_t3','$n°_debut_serie1_t3','$n°_fin_serie1_t3','$serie2_t3','$n°_debut_serie2_t3','$n°_fin_serie2_t3')"; 
       $result= MYSQL_QUERY($query); 
       
       if(mysql_error())
        { /* Erreur dans la base de donnees, sûrement la table qu'il faut créer */
           print "Erreur dans la base de données : ".mysql_error();
           print "<br>Importation stoppée.";
           exit();
        } 
          
         
         } 
   
     while (!feof($fp)) 
    {  
		$lignes = fgetss($fp,4096);   
		$nom_prenom_client = addslashes(rtrim(substr($lignes,0,40)));
		$code_banque = addslashes(rtrim(substr($lignes,41,3)));
		$code_agence = addslashes(rtrim(substr($lignes,44,5)));
		$n°_compte_client = addslashes(rtrim(substr($lignes,49,12)));
		$n°_debut_cheque = addslashes(rtrim(substr($lignes,61,9)));
		$n°_fin_cheque = addslashes(rtrim(substr($lignes,71,6)));
		$serie_utiliser = addslashes(rtrim(substr($lignes,77,2)));
		$type_chequier = addslashes(rtrim(substr($lignes,79,1)));
    
	if($type_chequier!='' && $serie_utiliser!='' && $n°_fin_cheque!='' && $n°_debut_cheque!='' && $n°_compte_client!='' && $code_agence!='' && $code_banque!='' && $nom_prenom_client!='')
	   $query1 = "INSERT INTO chequier VALUES('','$nom_prenom_client','$code_banque','$code_agence','$n°_compte_client','$n°_debut_cheque','$n°_fin_cheque'
	   ,'$serie_utiliser',$type_chequier)"; 
       if($ligne!='')
	   {
	   $result= MYSQL_QUERY($query1); 
 //  echo $query1.'<br />';
 
       if(mysql_error())
        { 
           print "Erreur dans la base de donnees : ".mysql_error();
           print "<br>Importation stoppee.";
           exit();
        }
	//	echo $query1.'<br />';
	  }
    } 

          
	}
	//if(isset($p))
	//fclose($fp);  
	         }
	

 echo "<script language='Javascript'>alert('Importation terminee, avec succes')</script>";
MYSQL_CLOSE(); 
closedir($dir);
?>
