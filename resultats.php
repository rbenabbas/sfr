<br />
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

include('commun.php');


/** Calcule le temps d'execution*/
function now()
{
list($usec, $sec) = explode(" ", microtime());
return ((float)$usec + (float)$sec);
}

/** On selectionne ou ? on fait la recherhce */

if($Etat==1)
 $table='dmd';
else
$table='ligne_comande';

$sql = "SELECT * " .
         "FROM  ".$table." N ";
		 
$sql=$sql.query_build();

if(!$af)
$Trier_par=" ORDER BY CASE WHEN N.propriete LIKE '$Pro%'
THEN 1
END DESC ";
elseif($af==1)
$Trier_par=" ORDER BY N.date_demande";
else
$Trier_par=' ORDER BY N.date_comande';

$sql =$sql .$Trier_par;
$sql=$sql.' limit '.$cmpt.','.$nb_resultats;
//echo '<br />'.$sql.'<br />'; 
$x=now();

$affichage=0;

include('Bd_Connect.php');
$resultat=mysql_query($sql,$id_connexion);
if($query)
$query='where '.$query; 
$tmps='<font color="red">'.Round(now() - $x, 2).' S </font>';
$res_con=mysql_query('SELECT Count(*) FROM '.$table.' N '.$query,$id_connexion);
$Nombre=mysql_fetch_array($res_con,MYSQL_NUM);
$nb_page=floor($Nombre[0]/$nb_resultats);
if(($nb_page*$nb_resultats)<$Nombre[0])
$nb_page++;
/** Affichage ****/
$current = $_SERVER['PHP_SELF'].'?';
if($Nombre[0]>0) 
{  

/** decorer le text*/
function affiche_ele($Pro,$res)
{
if($Pro)
  { 
    return(str_replace($Pro,'<span class="color_text">'.$Pro.'</span>', $res));
    }
	else return ($res);
  }


?>

 <div > 
<table width="100%" class='table_recherche' > 
<tr > <td  width="28%" height="20" colspan="2" class='summary_data'  > <b> <font color="#006633"> <?php   echo $Nombre[0]; ?> </font>&nbsp;&nbsp; <?php if($Etat==1) echo 'Demande'; else echo 'Commande'; ?> trouvés <?php echo $tmps;?> </b> 
   </td> 
<td width="39%" height="20" class='summary_data' > <b>Liste tri&eacute;e par </b> <select name="Affichage" onchange="envoyer_req('<?php echo $current.'&Index=0'; ?>');">  <option value="0" <?php if($af==0) echo "selected"; ?>> Propriétaire </option> <option value="1" <?php if($af==1) echo "selected"; ?>> Date de demande </option> <option value="2" <?php if($af==2) echo "selected"; ?>> Date de commande </option>  </select>  </td>
<td width="39%" height="20" class='summary_data' > <b>Résultats par page </b> <select name="nb_page"  onchange="envoyer_req('<?php echo $current.'&Index=0'; ?>');" > <option value="10" <?php if($nb_resultats==10) echo "selected"; ?> > 10 </option> <option value="20" <?php if($nb_resultats==20) echo "selected"; ?> > 20 </option> <option value="30" <?php if($nb_resultats==30) echo "selected"; ?> > 30 </option>  </select>  </td>
 </tr>  
 <tr bgcolor="#FFFFFF"    height="20px" style="text-align:left"  
			>  <td style="text-align:left" colspan="2" class='summary_data'    > 
<?php if($Etat==1) {?>
 <img  src="images/arrow_dotted.gif" title="Selectionner un element" border="0">
  <span id="panier">  <a href='#' class="lien"   onclick="ajouter_commande();"  >		 <img src="images/add_to_list.gif" title="Ajouter aux commandes" border="0" > <b  > Ajouter aux commandes   </b>  </a>  <span> <?php } elseif($Etat==2) {?> <font  color="#006633" size="+2"> * </font>Préparées <font  color="red" size="+2"> * </font>Non préparées     <?php }?> </td> <td colspan="2">
 <?php  if($Etat==2) { ?> <a href="#"  class="lien" onclick="voire_cmd_pre()"> <img src="images/plus.png" border="0" />  <b> Voir les commandes préparées </b> </a>  <?php }?> 
  
</td>
  <?php 


afficher($index);

}
else
{
?>
   <br /><font color="#330099" size="3" > 0  <?php if($Etat==1) echo 'Demande'; else echo 'Commande'; ?> (s) trouvée(s) <br /> Aucun ne correspond aux termes de recherche specifies. </font>
<?php }

function afficher($j)
{
 global $nb_page,$nb_resultats,$cmpt,$affichage,$resultat,$id_connexion,$index,$current,$Etat,$Pro,$Cod;

 while ($donnees=mysql_fetch_array($resultat,MYSQL_ASSOC) and ($affichage <$nb_resultats) )
 {
                      $cmpt++;
					  $affichage++;

?>

<tr bgcolor="#FFFFFF"  height="30px" style="text-align:left"   id='<?php echo $cmpt;?>';
			>  
            <td width="4%"  > <table> <tr> <td> <b> <?php if($Etat==2 and !$donnees['cmd_pre']) echo '<font color="red" size=12 > * </font>&nbsp;&nbsp;';
			
			elseif($Etat==2 and $donnees['cmd_pre']) echo '<font  color="#006633" size=12 > * </font>&nbsp;&nbsp;';
			 echo $cmpt;?> </b>   </td></tr> </table> <?php if($Etat==1) {?>  <input type="checkbox"   
    name="list" value="<?php echo $donnees['idf'];?>" id='<?php echo $donnees['idf'];?>' /><a href='#' class="lien"   onclick="ajouter_un_commande('<?php echo $donnees['idf'];  ?>');"  >		 <img src="images/add_to_list.gif" title="Ajouter aux commandes" border="0" >   </a> <?php }  ?> 
	  
     </td> <label>
      <td valign="top" colspan="3" class='summary_data' >
 &nbsp;&nbsp;  <b> Nom  : </b>    <?php  echo affiche_ele($Pro,$donnees['nom']); ?> &nbsp;&nbsp; <b> Adresse:  </b> <?php echo $donnees['adresse1']; ?>  <br />
		 
 &nbsp;&nbsp;  <b> Propriétaire  : </b>    <?php  echo affiche_ele($Pro,$donnees['propriete']); ?> &nbsp;&nbsp; <b> Rip:  </b> <?php echo $donnees['rip']; ?> <br />
		 
       <?php if($Etat==1) {?>   <b>&nbsp;&nbsp;  Code d'agence: </b> <?php echo $donnees['code_agence']; ?>    <br /> <?php }?>
  <b>&nbsp;&nbsp; Date de demande: </b> <?php echo $donnees['date_demande'];?> <br />  <b>&nbsp;&nbsp; Date de commande: </b>
<?php echo $donnees['date_comande'];?>      </td> </tr>	 
<?php }?>

<tr height=20 bgcolor="#CCCCCC" > 
 <td  colspan="2" class='summary_data'   >
       <?php if($Etat==1) {?>  <img src="images/arrow_ltr.png" ><input type="checkbox" 
    name="select_all" onClick="selectionner_tout();" value="select_all"  />  <b> Tout sl&eacute;ctionner </b> <?php } elseif($Etat==2) {?>  <a href="#"  class="lien"  onclick="envoyer_req('<?php echo $current.'&Index=0&env_cmd_pre=1'; ?>');"> <input type="hidden"   value="0" /><img src="images/plus.png" border="0" />  <b> Ajouter aux commandes préparées </b> </a>  <?php }?> </td>  <td>
    
      </td> <td> </td>
</tr> 
<tr  bgcolor="#FFFFFF">  <td colspan="4"   class="glossary"  align="center">
<?php 
if($index>=$nb_resultats)
			{
			

			echo '<a href="#" onClick="envoyer_req(\''.$current.'&Index=0&titre='.$Pro.'&auteur='.$Cod.'&is='.$Etat.'\')" > <font size="3"> << </font> </a> ';
			echo '<a href="#" onClick="envoyer_req(\''.$current.'&Index='.(($_GET['Index'])-$nb_resultats).'&titre='.$Pro.'&auteur='.$Cod.'&is='.$Etat.'\')" > <font size="3"> < </font> </a>';
			
			}
			$x=($j/$nb_resultats)%$nb_resultats;

			for($i=$j-($x*$nb_resultats),$k=0;($i<($nb_page*$nb_resultats)) and ($k<10);$i=$i+$nb_resultats,$k++)
			{ 
			 if($i==$j)
			  $focus='class="selected"';
			  else
			  $focus='';
			  
			  echo' <a href="#" '.$focus.' onClick="envoyer_req(\''.$current.'&Index='.($i).'&np='.$nb_resultats.'\')" > <font "3">'.($k+1).'</font></a>';	

		    }
			
	
			if(($index/$nb_resultats)<$nb_page-1)
			{
			
			echo ' <a href="#" onClick="envoyer_req(\''.$current.'&Index='.(($index)+$nb_resultats).'\')" ><font size="3"> > </font> </a>';
			echo '  <a href="#" onClick="envoyer_req(\''.$current.'&Index='.(($nb_page-1)*$nb_resultats).'&np='.$nb_resultats.'\')" ><font size="3"> >> </font> </a>';
			
			}

?>


 </td>
</table>
</form>
</div>
<?php 
} 
 
 
 ?>

