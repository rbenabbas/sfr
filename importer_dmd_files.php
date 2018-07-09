<?php

/* Connexion à la base de données */

require_once("Bd_Connect.php");
//On vide la TABLE
mysql_query("TRUNCATE TABLE dmd");

$dirname = './fichiers';
$dir = opendir($dirname); 
/** lires plusiers fichiers dans le dossier fichiers */
while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))
	{
	 
     
/* On ouvre le fichier à importer en lecture seulement 
       $file une variable contient le nom de fichier a importé 
         */
  
     $fp=fopen("fichiers/".$file,"r");
 
 
    while (!feof($fp)) /* on importe */
    { /* Tant qu'on n'atteint pas la fin du fichier */ 
       $ligne = fgetss($fp,4096); /* On lit une ligne */  
	   //$idf=$ligne;
	   $nom = rtrim(substr($ligne,0,40));	
	   $adresse1 = rtrim(substr($ligne,40,40));
	   $adresse1 = addslashes( $adresse1 );
	   $cp = rtrim(substr($ligne,80,7));
	   $adresse2 = rtrim(substr($ligne,87,18));
	   $code_agence = rtrim(substr($ligne,108,5));
	   $rip = rtrim(substr($ligne,105,21));
	   $type_de_cheque = rtrim(substr($ligne,127,1));
	   $nbr_cheque = rtrim(substr($ligne,126,2));
	   
	   $s = $file;
	   $propriet = $s[0].$s[1].$s[2].$s[3];
	   if($propriet=="BADR"){
	   $propriete= "BANK";
	   }
	   else{
	   $propriete="SATIM";
	   }
	   
	   $date_demande =  $s[7].$s[8].'/'.$s[9].$s[10];
	   $date_comande =  date("d/m/Y");
	   

	   
	    
	   
	    /* Ajouter un nouvel enregistrement dans la table */ 
	   
       $query = "INSERT INTO dmd VALUES('','$nom','$adresse1','$cp','$adresse2','$code_agence','$rip','$type_de_cheque','$nbr_cheque','$propriete','$date_demande','$date_comande')"; 
       $result= MYSQL_QUERY($query); 
       
       if(mysql_error())
        { /* Erreur dans la base de donnees, sûrement la table qu'il faut créer */
           print "Erreur dans la base de données : ".mysql_error();
           print "<br>Importation stoppée.";
           exit();
        } 
          
         
         } 
     

 

     fclose($fp); 
     

          
	}
}
 echo "<script language='Javascript'>alert('Importation terminee, avec succes')</script>";
MYSQL_CLOSE(); 
closedir($dir);
?>
