<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php        
header("Content-Type: application/msword");
header("Content-Disposition: attachment; filename=cmd_pre.doc");
require_once("Bd_Connect.php");

$sql ="SELECT * FROM commande";

$resultat=mysql_query($sql,$id_connexion);   
?>

<body>
<fieldset class="fieldset_recherche"> 

<table  width="100%" style="min-height:100px;"   class='table_recherche' border="1" bordercolor="#000000"> 

<tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'>
        
         <TD width="29"  style="text-align:center "  > <font color="#006633"> <b>N°</b> </font>  </TD>
<TD width="120" style="text-align:center "> <font color="#006633"> <b> NOMBRE D'AGENCE</b> </font>         </TD>
<TD width="134" style="text-align:center "><font color="#006633"> <b> DATE DE COMMANDE </b> </font>         </TD>
<TD width="148" style="text-align:center "> <font color="#006633"> <b> Nombre de chèque WD  </b></font>         </TD>
 <TD width="139" style="text-align:center "> <font color="#006633"> <b> Nombre de chèque WE</b></font>         </TD>
         <TD width="139" style="text-align:center "> <font color="#006633"> <b> Nombre de chèque 100</b></font>         </TD>


  </tr>
  <?php 
  $cmpt1=0;
  $cmpt2=0;
  $cmpt3=0;
  $cmp=0;
    while($donnees =mysql_fetch_array($resultat,MYSQL_ASSOC))
  {
  ?>
  <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'>
        
         <TD width="29"  style="text-align:center "  > <font color="#006633"> <b> <?php $cmp++; echo $cmp; ?> </b>
         </font> </TD>
         
         <TD width="120" style="text-align:center "> <font color="#006633"> <b><?php  echo $donnees['nbr_agence']; ?>  </b> </font></TD>
   <TD width="134" style="text-align:center "><font > <b> <?php  echo $donnees['date_commande']; ?>   </b></font></TD>      
   <TD width="148" style="text-align:center "> <font > <b>
   <?php  echo $donnees['nbt1'];  $cmpt1=$cmpt1+$donnees['nbt1']; ?> </b></font></TD>
    <TD width="139" style="text-align:center "> <font > <b> <?php  echo $donnees['nbt2']; $cmpt2=$cmpt2+$donnees['nbt2']; ?> </b></font></TD>
             <TD width="139" style="text-align:center "> <font > <b> <?php  echo $donnees['nbt3']; $cmpt3=$cmpt3+$donnees['nbt3']; ?> </b></font></TD>
   </tr>
  <?php
   }
  ?>
   <tr> <td colspan="3" style="text-align:center "> <b>TOTAL  </b>  
   <td style="text-align:center "> <b><?php echo $cmpt1; ?> </b> </td>     <td style="text-align:center "> <b><?php echo $cmpt2; ?> </b> </td>      <td style="text-align:center "> <b><?php echo $cmpt3; ?> </b> </td>  </tr>
  
         </table>
</form>
</fieldset>

</body>
</html>

