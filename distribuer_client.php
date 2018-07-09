<script language="javascript">
function detail(id)
{
 var height = 420;
 var width = 750;
 var top = (screen.height-height)/2;
 var left = (screen.width-width)/2;
 window.open("detail_agence.php?id="+id, "form_mod", "toolbar=no, location=no, directories=no, status=yes, scrollbars=yes,     resizable=no, width="+width+", height="+height+", left="+left+", top="+top);

}
 </script>
<fieldset class="fieldset_recherche"> 
<form action="header.php?p=5" name="recherche_form"  method="post">
<table  width="100%" style="min-height:100px;" > 
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Le client </b> </TD>
<TD width="592" style="text-align:left ">
<select class="cherche_champs" name="client"> 
<option value='1'> BADR </option>
<option> </option>
</select>

         </TD>
         </tr>



          <tr>
                     <TD width="139" height="28" style="text-align:left "></TD>  <TD width="592" style="text-align: right">
<input name="Creer" class="fieldset_recherche" type="submit" id="Créer" value="Créer"   />

                     </td>
                   </tr>



         
         </table>

         </form>
</fieldset>
<br />
<?php         if(isset($_POST['Creer'])) 
  {
    require_once("Bd_Connect.php");
 	$sql ="SELECT * FROM livraison";
     // Exécution de la requête SQL
     $resultat=mysql_query($sql,$id_connexion);   
     $row =mysql_fetch_array($resultat,MYSQL_ASSOC);
  ?>
  <table width="100%" class='table_recherche' > 
<tr > <td  width="28%" height="20"  class='summary_data'  colspan="4" > <b> <font color="#006633">  &nbsp;&nbsp; BON DE LIVRAISON - N° <?php echo $row['n_bon_livraison']+0; ?> </font>   </b> 

   </td> 
</tr>  
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td> &nbsp; <b> N° de Cde: <?php echo $row['num_commande']; ?>  </b> </td>  
<td colspan="2"> &nbsp; <b> Date la Cde: <?php echo rtrim(substr($row['date_commande'],0,2)).'/'.rtrim(substr($row['date_commande'],2,2)).'/'.rtrim(substr($row['date_commande'],4,4));	 ?> </b>   </td> <td>&nbsp; <b> Date de Production: <?php echo rtrim(substr($row['date_production'],0,2)).'/'.rtrim(substr($row['date_production'],2,2)).'/'.rtrim(substr($row['date_production'],4,4));	 ?> </b>  </td>

 </tr>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td> <font color="#006633">  &nbsp;  <b> QTE</b></font></td>
<td> <font color="#006633">  &nbsp;  <b> DESIGNATION</b></font></td>  <td><font color="#006633">  &nbsp; <b> Numéro Début </b>  </font></td>  <td> <font color="#006633">  &nbsp; <b> Numéro Fin </b></font></td> </tr>
<?php 
$resultat=mysql_query($sql,$id_connexion);   
     while($row =mysql_fetch_array($resultat,MYSQL_ASSOC))
     {
?>
<?php if($row['nbr_total_t1']+0) {?>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td>  &nbsp;  <b> <?php echo $row['nbr_total_t1'];?></b> &nbsp;&nbsp;  <a href="#" onclick="detail(1);"  class="lien"> <img src="images/plus.png" border="0" /> Détail des agences </a> </td>  <td>  &nbsp; <b> Chéquiers de 25 formules (<?php echo $row['serie1_t1'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie1_t1'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie1_t1'];?> </b></td>
</tr>
<?php }?>
<?php if($row['nbr_t2']+0) {?>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td>  &nbsp;  <b> <?php echo $row['nbr_t2'];?></b> &nbsp;&nbsp;  <a href="#" onclick="detail(2);"  class="lien"> <img src="images/plus.png" border="0" /> Détail des agences </a> </td>  <td>  &nbsp; <b> Chéquiers de 50 formules (<?php echo $row['serie1_t2'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie1_t2'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie1_t2'];?> </b></td>
</tr>
<?php }?>
<?php if($row['nbr_t3']+0) {?>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td>  &nbsp;  <b> <?php echo $row['nbr_t3'];?></b>&nbsp;&nbsp;   <a href="#"   class="lien"> <img src="images/plus.png" border="0" /> Détail des agences </a> </td>  <td>  &nbsp; <b> Chéquiers de 50 formules (<?php echo $row['serie1_t3'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie2_t3'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie2_t3'];?> </b></td>

<?php }?>


<?php } ?>
</tr>
<tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
  <TD width="592" style="text-align: right " colspan="5"> <a href='#' class="lien" onClick="sauv_word_dis();"> <img src="images/word.png " width="21" height="19"border="0" title="Sauver en word" >  </a>   <a href='#' class="lien" onClick="imprimer()"> <img src="images/qprint_sm.gif" border="0" title="Imprimer la liste" > </a>
 
         </TD>
         </tr>
</table>
   <?php }?>
