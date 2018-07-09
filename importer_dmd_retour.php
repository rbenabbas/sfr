<br />

<fieldset class="fieldset_recherche"> 
<form action="header.php?p=4" name="importer_form"  method="post" enctype="multipart/form-data">

<table  width="100%" style="min-height:100px;" > 
<tr>
           <td class="p1" colspan="2" > <b> Importer un fichier</b>  </td>
  </tr>
<tr>
         <TD width="100" height="28" style="text-align:left " class='summary_data' > <b> Le fichier</b></TD>
<TD width="592" style="text-align:left ">

<input type="file" name="file_dmd" size="120%">
 
         </TD>
         </tr>
<tr>
           <td colspan="2" style="text-align:right" > <input  name="envoyer" class="fieldset_recherche" type="submit" id="envoyer" value="Envoyer"   />
  </td>
  </tr>
       
         </table>
</form>
</fieldset>
 <?php


if(isset($_FILES['file_dmd']))
{
       $dossier = 'fichiers_retour/';
       $fichier = basename($_FILES['file_dmd']['name']);

//Si la fonction renvoie TRUE, c'est que ça a fonctionné...

     if(move_uploaded_file($_FILES['file_dmd']['tmp_name'], $dossier . $fichier)) 

     {
          
        



?>

<br />
<br />
<form action="header.php?p=4" name="importer_form_fichiers"  method="post" >  
<table width="100%" class='table_recherche' > 
<tr > <td  width="28%" height="20"  class='summary_data'  > <b> <font color="#006633">  &nbsp;&nbsp; Liste des fichiers... </font>   </b> 
   </td> 

 </tr>  

<?php 
 $dirname = './fichiers_retour';
        $dir = opendir($dirname); 
        /** lires plusiers fichiers dans le dossier fichiers */
while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))
	{
?>
 <tr bgcolor="#FFFFFF"   height="20px" style="text-align:left" class='summary_data'>  <td> &nbsp;&nbsp; <img src="images/file.png" > <b>  <?php echo $file;  ?> </b> </td>
<?php }
 } ?>
<tr > <td  width="28%" height="20"  class='summary_data'  > 
<input  name="Importer" class="fieldset_recherche" type="submit" id="Importer" value="Importer"   />
   </td> 

 </tr> 
</table>
</form>
<?php


     }
     else 
//Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
if(isset($_POST['Importer']))
/**Importer les fichiers  */
include ('importation_fichier_retoure.php');

?>
