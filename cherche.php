
 
<?php 



include('Bd_Connect.php');
/** le Nom*/

if (isset ($_POST['Nom'])) {
$Nom=addslashes (strip_tags ($_POST['Nom']));
$Nom_af=stripslashes($_POST['Nom']);

}
else
{
 $Nom_af='';
 $Nom=0;
}


/** le Pro*/

if (isset ($_POST['Pro'])) {
$Pro=addslashes (strip_tags ($_POST['Pro']));
$Pro_af=stripslashes($_POST['Pro']);
}
else
{
 $Pro_af='';
 $Pro=0;
}
/**l'Code Agence*/
if (isset ($_POST['Code_Agence'])) {
$Cod=addslashes (strip_tags ($_POST['Code_Agence']));
$Cod_af=stripslashes($_POST['Code_Agence']);
}
else
{
 $Cod_af='';
 $Cod='';
}
/**Etat */
if (isset ($_POST['Etat'])) {
$Etat=addslashes (strip_tags ($_POST['Etat']));
$Etat_af=stripslashes($_POST['Etat']);
}
else
{
$Etat_af='';
$Etat=0;
}


if (isset ($_POST['id_ele'])) 
{
include('Bd_Connect.php');
 $id_ele=addslashes (strip_tags ($_POST['id_ele']));
 $num_id=preg_split('/\*/',$id_ele, -1, PREG_SPLIT_OFFSET_CAPTURE);
 $Nombre=substr_count($id_ele,'*');
 for($i=0;$i<$Nombre;$i++)
 {
 $sql = "SELECT * FROM  dmd N where idf=".$num_id[$i][0];
 $resultat=mysql_query($sql,$id_connexion);
 $donnees=mysql_fetch_array($resultat,MYSQL_ASSOC);
	   $nom = addslashes (strip_tags ($donnees['nom']));
	   $adresse1 =addslashes (strip_tags ($donnees['adresse1']));
	   $cp = addslashes (strip_tags ($donnees['cp']));
	   $adresse2 = addslashes (strip_tags ($donnees['adresse2']));
	   $code_agence = addslashes (strip_tags ($donnees['code_agence']));
	   $rip = addslashes (strip_tags ($donnees['rip']));
	   $type_de_cheque =addslashes (strip_tags ($donnees['type_de_cheque']));
	   $nbr_cheque = addslashes (strip_tags ($donnees['nbr_cheque']));
	   $propriete = addslashes (strip_tags ($donnees['propriete']));
	   $date_demande =  addslashes (strip_tags ($donnees['date_demande']));
	   $date_comande =  addslashes (strip_tags ($donnees['date_comande']));
           /**Inserer dans la table ligne commande */
           $sql = "INSERT INTO ligne_comande VALUES ('','$nom','$adresse1','$cp','$adresse2','$rip','$type_de_cheque','$nbr_cheque','$propriete','$date_demande','$date_comande',0)"; 
           $resultat=mysql_query($sql,$id_connexion);
            /**Supprimer l'enregistrement dans la table dmd */
           $sql =" delete from dmd where idf=".$donnees['idf']; 
           $resultat=mysql_query($sql,$id_connexion);
           


 }



}

else
$id_ele=0;

/**Le trie de la page de recherche */ 
if (isset ($_POST['Affichage'])) 
$af=addslashes (strip_tags ($_POST['Affichage']));
else
$af=0;



/** le nombre d'ele sur page*/
if (isset ($_POST['nb_page'])) 
$nb_resultats=addslashes (strip_tags ($_POST['nb_page']));
else
$nb_resultats=10;

if(isset($_GET['Index'])) 
{$cmpt=$_GET['Index']; $index=$_GET['Index'];} 
else {$cmpt=0; $index='';}
if(isset($_GET['env_cmd_pre']))
{
 
  include('Bd_Connect.php');
  $sql = "SELECT * FROM ligne_comande where cmd_pre <> 1 group by adresse1";
  $resultat=mysql_query($sql,$id_connexion);
  while($donnees=mysql_fetch_array($resultat,MYSQL_ASSOC))
  {
     $date_commande=date("Y-n-j");
     $adr=$donnees['adresse1'];	 
$resultat_1=mysql_query("SELECT * FROM ligne_comande where adresse1='".$adr."'",$id_connexion);
  $nbr_agence=0;
  $nbt1=0;
  $nbt2=0;
  $nbt3=0;
  while($donnees_1=mysql_fetch_array($resultat_1,MYSQL_ASSOC))
  {
    $nbr_agence++;
	//echo $donnees_1['rip'].'<br /> ';
	$nbt=substr($donnees_1['rip'],20,1);
	if($nbt==1)
	$nbt1++;
	elseif($nbt==2)
	$nbt2++;
	elseif($nbt==3)
	$nbt3++;
	
	}

	  $sql_1 = "INSERT INTO commande VALUES ('','','$nbr_agence','$date_commande','$nbt1','$nbt2','$nbt3')";
	
	 mysql_query($sql_1,$id_connexion);
	 $sql_2="update ligne_comande set cmd_pre=1 where adresse1='".addslashes($donnees['adresse1'])."'";
	 	 mysql_query($sql_2,$id_connexion);
	
  }
}
			

?>


<fieldset class="fieldset_recherche"> 
<form action="header.php" name="recherche_form"  method="post">
<input  type="hidden" name="id_ele" id="id_ele"   />
<table  width="100%" style="min-height:100px;" > 
<tr>
           <td class="p1" colspan="2" > <b> Recheche Simple</b> <br /><img  src="images/etoile.jpg" width="22" height="21" /> Si vous choisissez 2 critères, la recherche ramène des commandes ou des demande qui correspondent à l'un ET à l'autre des critères. </td>
  </tr>
<tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Dans le Nom </b></TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();" id="ac1" autocomplete="off"  class="cherche_champs" name="Nom" <?php if(isset ($Nom_af)) echo 'value="'.$Nom_af.'"'; ?>  />
 
         </TD>
         </tr>

        <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b>  Propriétaire </b></TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();"  autocomplete="off"  class="cherche_champs" name="Pro" <?php if(isset ($Pro)) echo 'value="'.$Pro_af.'"'; ?>  />
 
         </TD>
         </tr>
         
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' ><b>Code Agence </b></TD>
<TD width="592" style="text-align:left ">
<input type="text" id="ac2" class="cherche_champs" autocomplete="off"  name="Code_Agence" <?php if(isset ($Cod_af)) echo 'value="'.$Cod_af.'"'; ?> />
         </TD>
         </tr>
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Etat </b></TD>
<TD width="592" style="text-align:left ">
<select class="cherche_champs" name="Etat"> 
<option value='1' <?php if($Etat==1) echo 'selected=selected'; ?>  > Demande </option>
<option value='2' <?php if($Etat==2) echo 'selected=selected'; ?>  > Commande</option>
<option> </option>
</select>

         </TD>
         </tr>
          <tr>
                     <TD width="139" height="28" style="text-align:left "></TD>  <TD width="592" style="text-align: right">
<input name="Rechercher" class="fieldset_recherche" type="submit" id="Rechercher" value="Rechercher"   />
                         <input name="reset" type="button" class="fieldset_recherche" value="Effacer"  onclick="effacer();" />
                     </td>
                   </tr>
         
         </table>
</fieldset>

 <div align="center" style="width:100%;">
 <?php 

   include("resultats.php"); 
   
 
 ?>
 </div>
