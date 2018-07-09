 <script type="text/javascript" src="javascript/traitement_recherche.js"></script>
<?php 
// Connexion SQL
$id=addslashes (strip_tags ($_GET['id']));
include('Bd_Connect.php');
if(isset($_POST['Modifier']))
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


$sql ="UPDATE user SET login='$nom',mot_passe='$pass',mail='$mail',role=$role where num_user=$id"; 
mysql_query($sql,$id_connexion);

              ?>

              <div> <b> L'utilisateur est bien modifié </b>
<a href="#" onClick="fermer_box()" > Fermer  </a></div>


<?php 
}
}

             
             $sql ="SELECT * FROM user WHERE num_user=$id";
             // Exécution de la requête SQL
             $resultat=mysql_query($sql,$id_connexion);   
             $row =mysql_fetch_array($resultat,MYSQL_ASSOC);

             
             



?>

<htm>
<head>
 <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css" />
 <script type="text/javascript" src="javascript/traitement_recherche.js"></script>
</head>
<body>
<fieldset class="fieldset_recherche"> 
<form action="user_mod.php?id=<?php echo $id; ?>" name="recherche_form"  method="post">
<input  type="hidden" name="id_ele" id="id_ele"   />
<table  width="100%" style="min-height:100px;" > 
<tr>
           <td class="p1" colspan="2" > <b>Créer un user</b> </td>
  </tr>
<tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Login </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();" id="ac1" autocomplete="off"  class="cherche_champs" name="login"  value="<?php  echo addslashes ($row['login']); ?>"  />
 
         </TD>
         </tr>

        <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Mot de passe </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="password"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();"  autocomplete="off"  class="cherche_champs" name="mdp_a"  value="<?php  echo addslashes ($row['mot_passe']); ?>" />
 
         </TD>
         </tr>
         
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' ><b>Retaper mot de passe</b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="password" id="ac2" class="cherche_champs" autocomplete="off"  name="mdp_b"  value="<?php  echo addslashes ($row['mot_passe']); ?>"/>
         </TD>
         </tr>

<tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> E-mail </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<input type="text"   onMouseOver="ddrivetip('',435,null,'id1');" onMouseOut="hideddrivetip();" id="ac1" autocomplete="off"  class="cherche_champs" value="<?php  echo addslashes ($row['mail']); ?>"  name="mail" />
 
         </TD>
         </tr>
         <tr>
         <TD width="139" height="28" style="text-align:left " class='summary_data' > <b> Le role </b> <font color="red">* </font> </TD>
<TD width="592" style="text-align:left ">
<select class="cherche_champs" name="role"> 
<option value='1' <?php if($row['role']==1) echo 'selected=selected;'?> > Administrateur </option>
<option value='2' <?php if($row['role']==2) echo 'selected=selected;'?> > Utilisateur</option>
<option> </option>
</select>

         </TD>


          <tr>
                     <TD width="139" height="28" style="text-align:left "></TD>  <TD width="592" style="text-align: right">
<input name="Modifier" class="fieldset_recherche" type="submit" id="modifier" value="Modifier"   />
                         <input name="effacer" type="button" class="fieldset_recherche" value="Effacer" onClick="effacer_ele()"  /> 
<input name="annuler" class="fieldset_recherche"  type="button" onClick="fermer_box()" id="annuler" value="Annuler"/>

                     </td>
                   </tr>
        <tr> 
<TD width="139" height="28" style="text-align:left "></TD> 
<TD width="139" height="28" style="text-align:left " class='summary_data'>
Les champs marqués du symbole <font color="red">* </font> sont obligatoires. </TD></tr>
  
         </table>
</form>
</fieldset>
</body>
</html>
