<?php
// Initialisation de la session
session_start() ;
function verification($nom,$pass){
             // Connexion SQL
             global $role;
             include('Bd_Connect.php');
             $sql ="SELECT * FROM user WHERE login='$nom' AND mot_passe='$pass'";
             // Exécution de la requête SQL
             $resultat=mysql_query($sql,$id_connexion);   
             if($row =mysql_fetch_array($resultat,MYSQL_ASSOC))
             /*if($row['nbres'] == 1)*/{
              $role= $row['role']; 
              return TRUE;
             }else{
               return FALSE;
             }
           }

// Si on a reçu les données d’un formulaire :
if ( isset( $_POST['pseudo'] ) && isset ( $_POST['motdepasse'] ) ) {
 
if($_POST['pseudo']!='' and $_POST['motdepasse']!='' )
{
 // On les récupère
  $nom = addslashes (strip_tags ($_POST['pseudo'])) ;
  $motdepasse = addslashes (strip_tags ($_POST['motdepasse'])) ;
                                                               
   // On teste si le mot de passe est valide :
   if ( verification( $nom, $motdepasse ) ) {
     // Le mot de passe est valide, l’utilisateur est identifié
      // On change d’identifiant de session
//      session_regenerate_id() ;
      // On sauvegarde donc son nom dans la session
         $_SESSION['nom'] = $nom ;
         $_SESSION['role'] = $role ; 
     $message = 'vous êtes correctement identifié' ;
     header("location: header.php");
   } else {
       // sinon on avertit l’utilisateur :
       $message = 'Mauvais mot de passe&nbsp;&nbsp;' ;
       $message .='<a href="index.php">Retour</a>' ;
   }
}
else {
              // Un des champs n’est pas rempli
   $message = 'le login ou le mot de passe est vide&nbsp;&nbsp;' ;
   $message .='<a href="index.php" >Retour</a>' ;
}
}

 else {
              // Un des champs n’est pas rempli
   $message = 'le login ou le mot de passe est vide&nbsp;&nbsp;' ;
   $message .='<a href="index.php">Retour</a>' ;
}
?>
<html>
<head><title>Identification</title></head>
<body><p>
<?php echo $message ?>
</p></body>
</html>
