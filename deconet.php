<?php 
session_start();
// On vérifie si l’utilisateur est identifié
if ( !isset( $_SESSION['nom'] )) {
  // La variable de session n’existe pas,
  // donc l’utilisateur n'est pas authentifié
  // On redirige sur la page permettant de s’authentifier
  header('Location: index.php');
  // On arrête l’exécution
  exit() ;
}
unset($_SESSION['nom']);
unset($_SESSION['role']);
header('Location: index.php');
  // On arrête l’exécution
  exit() ;

?>
