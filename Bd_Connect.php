<?php 
$id_connexion=mysql_connect("localhost","root","") or die("Impossible de se connecter : " . mysql_error());
$id_selection=mysql_select_db("dmd_1",$id_connexion);
if (!$id_selection) {die ('Impossible de sélectionner la base de données : ' . mysql_error());}

mysql_query("SET NAMES 'UTF8' ");

?>
