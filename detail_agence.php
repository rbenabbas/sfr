<?php 
$type=addslashes (strip_tags ($_GET['id']));
if($type==1)
{
 $t='WD';
 $msg='Série: WD chéquier de 25 formules';
}
else
if($type==2)
{
$t='WE';
$msg='Série: WE chéquier de 50 formules';
}
    require_once("Bd_Connect.php");
 	$sql ="SELECT  DISTINCT `code_agence` FROM chequier where serie_utiliser='$t'";
	//echo $sql; 
	$resultat=mysql_query($sql,$id_connexion);   
?>
<htm>
<head>
 <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css" />
  <script type="text/javascript" src="javascript/traitement_recherche.js"></script>

</head>
<body>
<fieldset class="fieldset_recherche"> 

<table  width="100%" style="min-height:100px;"   class='table_recherche'> 
<tr>
           <td class="p1" colspan="2" > <b> <?php echo $msg;?> </b> </td>
  </tr>
<tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'>
        
         <TD width="592"  style="text-align:center "  > <font color="#006633"> <b> AGENCES</b> </font>  </TD>
<TD width="592" style="text-align:center "> <font color="#006633"> <b> CODE AGENCE </b> </font>
 
         </TD>
<TD width="592" style="text-align:center "><font color="#006633"> <b> N° Premier chèque </b> </font>

 
         </TD>
<TD width="592" style="text-align:center "> <font color="#006633"> <b> N° Dernier chèque </b></font>

 
         </TD>
         <TD width="592" style="text-align:center "> <font color="#006633"> <b> N° Nombre</b></font>

 
         </TD>


         </tr>
         <?php       
          $cmp=0;
		   while($row =mysql_fetch_array($resultat,MYSQL_ASSOC))
		  {
		    $numéro_agence=$row['code_agence'];
?>
<tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
 <?php    
    /**code d'agendce  */
	$res=mysql_query("select * from agence where code_agence=".$numéro_agence,$id_connexion);
	 
             $ro=mysql_fetch_array($res,MYSQL_ASSOC)
    ?>

 <TD width="592" height="28" style="text-align:center "  > <b> <?php echo $ro['libelle']; ?></b>  </TD>

<TD width="592" style="text-align:center "> <b> <?php echo $numéro_agence; ?> </b>
 
         </TD>
 <?php    
    /**code d'agendce  */
 $res=mysql_query("select count(*) as nbr from chequier where code_agence='".$numéro_agence."' and serie_utiliser='$t' ",$id_connexion);

             $ro=mysql_fetch_array($res,MYSQL_ASSOC);
			 $nbr=$ro['nbr'];
			 $cmp=$cmp+$nbr;
    ?>

<TD width="592" style="text-align:center "> <b> 
 <?php    
    /**code d'agendce  */

 $res=mysql_query("select * from chequier where code_agence='".$numéro_agence."' and  serie_utiliser='$t' ",$id_connexion);
             $ro=mysql_fetch_array($res,MYSQL_ASSOC);
			 $numéro_chq_debut=$ro['n°_debut_cheque'];
			 while($ro=mysql_fetch_array($res,MYSQL_ASSOC))

			 $numéro_chq_fin=$ro['n°_fin_cheque'];
echo $numéro_chq_debut; 

    ?>


 </b>

 
         </TD>
<TD width="592" style="text-align:center "> <b> <?php echo $numéro_chq_fin; ?>  </b>

 
         </TD>
         <TD width="592" style="text-align:center "> <b> <b> <?php echo $nbr; ?></b> </b>

 
         </TD>
    

</tr>
<?php 


}?>
  <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
  <TD width="592" style="text-align:center " colspan="4"> <b> <b> TOTAL</b> </b>

 
         </TD>
    
    <TD width="592" style="text-align:center " > <b> <b> <?php echo $cmp; ?></b> </b>

 
         </TD>
    
  
  </tr>
  
  <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
  <TD width="592" style="text-align: right " colspan="5"> <a href='#' class="lien" onclick="sauv_word(<?php echo $type;?>);"> <img src="images/word.png " width="21" height="19"border="0" title="Sauver en word" >  </a>   <a href='#' class="lien" onClick="imprimer()"> <img src="images/qprint_sm.gif" border="0" title="Imprimer la liste" > </a>
 
         </TD>
         </tr>
         </table>
</form>
</fieldset>

</body>
</html>