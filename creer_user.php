<?php 
// Connexion SQL
include('Bd_Connect.php');
if(isset($_POST['Creer']))
{

$nom=addslashes (strip_tags ($_POST['login']));
$pass=addslashes (strip_tags ($_POST['mdp_a']));
$pass_b=addslashes (strip_tags ($_POST['mdp_b']));
$mail=addslashes (strip_tags ($_POST['mail']));
$role=addslashes (strip_tags ($_POST['role']));
if(!$nom)
echo '<div> <b> &nbsp; <font color="red">  Le login est vide  </b> </font></div> ';
elseif(!$pass or !$pass_b) 
echo '<div> <b> &nbsp; <font color="red">  Le mot de passe est vide  </b> </font></div> ';
elseif($pass!=$pass_b)
echo '<div> <b> &nbsp; <font color="red">  Les mots passe ne sont pas identique  </b> </font></div> ';
elseif(!$mail)
echo '<div> <b> &nbsp; <font color="red">  Le E-mail est vide  </b> </font></div> ';

else
{
// Vérification si l'user existe déja

             
             $sql ="SELECT count(*) as nbres FROM user WHERE login='$nom'";
             // Exécution de la requête SQL
             $resultat=mysql_query($sql,$id_connexion);   
             $row =mysql_fetch_array($resultat,MYSQL_ASSOC);
             if($row['nbres'] == 0)
              {  
              $sql ="INSERT INTO user VALUES('',$role,'$nom','$pass','$mail')"; 
              $resultat=mysql_query($sql,$id_connexion);
              //echo $sql; 
              ?>

              <div> <b> Le user est bien Crée </b></div>
 <?php
              }
             else
             {  
             ?>
               <div>  &nbsp; <font color="red">  <b> Le login existe déja dans la base  </b> </font> </div>

<?php
}             
}
}

if(isset($_GET['del']))
{
      $id=addslashes (strip_tags ($_GET['del']));
      mysql_query("delete from user where num_user=".$id,$id_connexion);   
	  ?>
	  <script language="javascript"> alert("L'utilisateur est bien supprimé"); </script>
	  <?php
 }



?>


<fieldset class="fieldset_recherche"> 
<form action="header.php?p=3" name="recherche_form"  method="post">
<input  type="hidden" name="id_ele" id="id_ele"   />
<table  width="100%" style="min-height:100px;" > 
<tr>
           <td class="p1" colspan="2" > <b>Créer un user</b> </td>
  </tr>
<tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Login </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();" id="ac1" autocomplete="off"  class="cherche_champs" name="login"   />
 
         </TD>
         </tr>

        <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Mot de passe </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="password"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();"  autocomplete="off"  class="cherche_champs" name="mdp_a"/>
 
         </TD>
         </tr>
         
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' ><b>Retaper mot de passe</b> <font color="red">* </font>  </TD>
<TD width="592" style="text-align:left ">
<input type="password" id="ac2" class="cherche_champs" autocomplete="off"  name="mdp_b" />
         </TD>
         </tr>

<tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> E-mail </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();" id="ac1" autocomplete="off"  class="cherche_champs" name="mail"   />
 
         </TD>
         </tr>
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Le role </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<select class="cherche_champs" name="role"> 
<option value='1'> Administrateur </option>
<option value='2'> Utilisateur</option>
<option> </option>
</select>

         </TD>
         </tr>



          <tr>
                     <TD width="139" height="28" style="text-align:left "></TD>  <TD width="592" style="text-align: right">
<input name="Creer" class="fieldset_recherche" type="submit" id="Créer" value="Créer"   />
                         <input name="reset" type="reset" class="fieldset_recherche" value="Effacer"   />
                     </td>
                   </tr>



 <tr> 
<TD width="139" height="28" style="text-align:left "></TD> 
<TD width="139" height="28" style="text-align:left " class='summary_data'>
Les champs marqués du symbole <font color="red">* </font> sont obligatoires. </TD></tr>
         
         </table>
</fieldset>


<?php 
             $sql ="SELECT count(*) as nbres FROM user";
             // Exécution de la requête SQL
             $resultat=mysql_query($sql,$id_connexion);   
             $row =mysql_fetch_array($resultat,MYSQL_ASSOC);
             if($row['nbres'] > 0)
             {
?>
<br />
<form action="header.php?p=2" name="importer_form_fichiers"  method="post" >  
<table width="100%" class='table_recherche' > 
<tr > <td  width="28%" height="20"  class='summary_data' colspan="2"  > <b> <font color="#006633">  &nbsp;&nbsp; Liste des utilisateurs... (<?php echo $row['nbres']; ?>) </font>   </b> 
</td> 

 </tr>  

<?php 
             $sql ="SELECT * FROM user";
             // Exécution de la requête SQL
             $resultat=mysql_query($sql,$id_connexion);   
             while($row =mysql_fetch_array($resultat,MYSQL_ASSOC))
             {
             ?>
    <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'>
       <td  width="28%" height="20"  class='summary_data' colspan="2"  > &nbsp;&nbsp; <b> Login: </b> <?php echo $row['login']; ?>  &nbsp;&nbsp; <b> E-mail: </b> <?php echo $row['mail']; ?> <img src="images/edit.png" title='modifier' onClick='show_user_mod(<?php echo $row['num_user']; ?>);'>  <a href="header.php?p=3&del=<?php echo $row['num_user'];?>" > <img src="images/delete.png" title='supprimer' border="0">  </a></td>
    </tr>  
<?php
}
?>

</table>
<?php } ?>
