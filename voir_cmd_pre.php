<?php 
require_once("Bd_Connect.php");

$sql ="SELECT * FROM commande";

$resultat=mysql_query($sql,$id_connexion);   

?>
<htm>
<head>
 <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <script type="text/javascript" src="javascript/traitement_recherche.js"></script>

</head>
<body>
<fieldset class="fieldset_recherche"> 

<table  width="100%" style="min-height:100px;"   class='table_recherche'> 
<tr>
           <td class="p1" colspan="2" > <b> <?php echo '';?> </b> </td>
  </tr>
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
  <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'> 
  <TD style="text-align: right " colspan="6"> <a href='#' class="lien" onClick="sauv_word_cmd_pre();"> <img src="images/word.png " width="21" height="19"border="0" title="Sauver en word" >  </a>   <a href='#' class="lien" onClick="imprimer()"> <img src="images/qprint_sm.gif" border="0" title="Imprimer la liste" > </a>         </TD>
  </tr>
         </table>
</form>
</fieldset>

</body>
</html>