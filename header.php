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

if(isset($_GET['p']))
$id=$_GET['p'];
else
$id=1;
$msg='Chercher demande';
if($id==1)
{
$p='cherche.php'; 
$msg='Chercher demande';
}
elseif($id==2)
{
$p='importer_dmd.php'; 
$msg='Importer une Demande';
}
elseif($id==3)
{
 
  
  $p='creer_user.php'; 
  $msg='Gérer les utilisateurs';
 
}
elseif($id==4)
{
$p='importer_dmd_retour.php'; 
$msg='Importer le fichier de retour';
}
elseif($id==5)
{
$p='distribuer_client.php'; 
$msg='Distribuer demandes';
}




?>


<link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css" />
 <script type="text/javascript" src="javascript/traitement_recherche.js"></script>
 <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8" />
<div align="center"> <img src="images/logo.jpg" border="0" width="80" height="80" /> </div>
<div align="center"> <table  cellpadding="0" cellspacing="0" border="0">
            <table style="width:100%; text-align:right" align="right">
         <tr>
           <td>
             <table align="center" style="width:100%" cellpadding="0" cellspacing="0" border="0">
             <tr> 
              <td style="background-image:url(images/bg-menu-left.png); width:10px; height:38px;">&nbsp;</td>
              <td style="text-align:center">                         
                <ul class="menu">            
                  <li><a href="header.php?p=1"  > Chercher une demande </a></li>
                                       
                  <li><a href="header.php?p=2"  > Importer une demande</a></li>
                  <li><a href="header.php?p=4"  > Importer le fichier de retour</a></li>
                  <li><a href="header.php?p=5"  > Distribuer les demandes</a></li>
                  
                    <?php if($_SESSION['role']==1) { ?>
                   <li><a href="header.php?p=3"  > Gérer les utilisateurs </a></li>
                    <?php }?>

                                                  
                </ul>
              
              </td>
              <td style="background-image:url(images/bg-menu-right.png); width:20px; height:38px;">&nbsp;</td>              
            </tr>
           </table>
           </table> </div>

<div align="right"> <a class='lien' href="deconet.php"> <b>Déconnexion</b>  </a> &nbsp;&nbsp;</div>
<br />
<table width="100%">
<tr> <td valign='top'> <table align="center" style="width:100%" cellpadding="0" cellspacing="0" border="0">
             <tr> 
              <td style="background-image:url(images/bg-menu-left.png); width:10px; height:38px;">&nbsp;</td>
<td style="text-align:center">
 
 <ul class="menu">            
                  <li><a href="#"  > <?php echo $msg; ?> </a></li> </ul>    </td>

 <td style="background-image:url(images/bg-menu-right.png); width:20px;
 height:38px;">&nbsp;</td> 
             
            </tr>
<tr>
<td colspan="3"> 


</td>


 </tr>
           </table>  </td> <td> <?php include($p);?> </td> </tr>
</table>
