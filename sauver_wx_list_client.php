<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php        
header("Content-Type: application/msword");
header("Content-Disposition: attachment; filename=client.doc");

    require_once("Bd_Connect.php");
 	$sql ="SELECT * FROM livraison";
     // Exécution de la requête SQL
     $resultat=mysql_query($sql,$id_connexion);   
     $row =mysql_fetch_array($resultat,MYSQL_ASSOC);
  ?>
  <table width="100%"  border="1" bordercolor="red" > 
<tr > <td  width="28%" height="20"  class='summary_data'  colspan="4" > <b> <font color="#006633">  &nbsp;&nbsp; BON DE LIVRAISON - N° <?php echo $row['n_bon_livraison']+0; ?> </font>   </b> 

   </td> 
</tr>  
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" > 
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
<td>  &nbsp;  <b> <?php echo $row['nbr_total_t1'];?></b> &nbsp;&nbsp; </td>  <td>  &nbsp; <b> Chéquiers de 25 formules (<?php echo $row['serie1_t1'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie1_t1'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie1_t1'];?> </b></td>
</tr>
<?php }?>
<?php if($row['nbr_t2']+0) {?>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td>  &nbsp;  <b> <?php echo $row['nbr_t2'];?></b> &nbsp;&nbsp;   </td>  <td>  &nbsp; <b> Chéquiers de 50 formules (<?php echo $row['serie1_t2'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie1_t2'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie1_t2'];?> </b></td>
</tr>
<?php }?>
<?php if($row['nbr_t3']+0) {?>
<tr  bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
<td>  &nbsp;  <b> <?php echo $row['nbr_t3'];?></b>&nbsp;&nbsp;   </td>  <td>  &nbsp; <b> Chéquiers de 50 formules (<?php echo $row['serie1_t3'];?>) </b>  </td>  <td>   &nbsp; <b> <?php echo $row['n°_debut_serie2_t3'];?>  </b></td> <td>   &nbsp;  <b> <?php echo $row['n°_fin_serie2_t3'];?> </b></td>

<?php }?>


<?php } ?>
</tr>
</table>


<body>
</body>
</html>
