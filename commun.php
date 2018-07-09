<?php 

// On vérifie si l’utilisateur est identifié
if ( !isset( $_SESSION['nom'] )) {
  // La variable de session n’existe pas,
  // donc l’utilisateur n'est pas authentifié
  // On redirige sur la page permettant de s’authentifier
  header('Location: index.php');
  // On arrête l’exécution
  exit() ;
}


/**Fonction query_build construction d'une requette */ 
function query_build() {

global $Pro,$Cod,$Etat,$Nom,$sql,$query; 

$Pro = trim($Pro); $Cod = trim($Cod);
$Etat = trim($Etat); 

/** Traitement du Nom*/


$query = "";
if ($Nom) 
 {


  $key = str_replace("*", "%", $Nom);


   if ($query)
     $query = $query .' AND ';
	 $query = $query . "(N.nom LIKE '%" . $key ."%')";  
	

	  
}

/** Traitement du Pro*/



if ($Pro) 
 {

  $key = str_replace("*", "%", $Pro);
   if ($query)
     $query = $query .' AND ';
	 $query = $query . "(N.propriete LIKE '%" .$key ."%')";  


	  
}
/** Traitemet de code d'agence*/
if ($Cod) 
 {




  $key = str_replace("*", "%", $Cod);
 

   if ($query)
$query = $query .' AND ';
	 $query = $query . "(N.code_agence LIKE '%" . $key ."%')";  

	  
}

    
    if($query)
	return ('Where ('.$query.')');
	return ('');
}

?>
