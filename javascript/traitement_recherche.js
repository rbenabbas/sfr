/** Les champs check dans le résultat de la recherche */
var option=0;
var id_sup=0;
var id_ajou;
var show_choix;
/**Fermer le box*/
function fermer_box()
{
  window.close();
}
/***Effacer les éléments */
function effacer_ele()
{
  document.recherche_form.login.value='';
  document.recherche_form.mdp_a.value='';
  document.recherche_form.mdp_b.value='';
  document.recherche_form.mail.value='';
}
/* Select All**/
function selectionner_tout()
{
if(option==0)
    {
for (i = 0; i < document.getElementsByName('list').length; i++)
	document.getElementsByName('list')[i].checked = true ;
option=1;
	}	
else
   {
for (i = 0; i < document.getElementsByName('list').length; i++)
	document.getElementsByName('list')[i].checked = false ;
	option=0;
   }	
}
/** Une fonction pour envoyer  une requette  */

function envoyer_req(req)
{
	document.recherche_form.action=req;
		document.recherche_form.submit();
}
/** Vérifier si chéched*/ 
function verifier_check()
{
	for (i = 0; i < document.getElementsByName('list').length; i++)
	 if (document.getElementsByName('list')[i].checked ==true && !document.getElementsByName('list')[i].disabled) 
	 return (true);
	 return  (false);
	
}
/** **/
function ajouter_commande() 
{
 var ele='';
if(verifier_check())
{
for (i = 0; i < document.getElementsByName('list').length; i++)
if (document.getElementsByName('list')[i].checked ==true)
ele=document.getElementsByName('list')[i].value+'*'+ele;

document.recherche_form.id_ele.value=ele;
alert('Votre demandes a été ajoutées à la liste des commandes');
envoyer_req('header.php');
}
else
alert("Séléctionner un élément");
}
/****/
function effacer()
{
document.recherche_form.Nom.value='';
document.recherche_form.Pro.value='';
document.recherche_form.Code_Agence.value='';
document.recherche_form.Etat.value='1';
}
/****/
function ajouter_un_commande(id)
{
 
var ele='';
ele=id+'*';
document.recherche_form.id_ele.value=ele;
alert('Votre demande a été ajoutée à la liste des commandes');
envoyer_req('header.php');

 }
/***Ouvrir */ 
function show_user_mod(id)
{
 var height = 420;
 var width = 750;
 var top = (screen.height-height)/2;
 var left = (screen.width-width)/2;
 window.open("user_mod.php?id="+id, "form_mod", "toolbar=no, location=no, directories=no, status=yes, scrollbars=yes,     resizable=no, width="+width+", height="+height+", left="+left+", top="+top);
}
function sauv_word(id)
{
document.location='sauver_wx.php?id='+id;
	}
function sauv_word_dis()
{
document.location='sauver_wx_list_client.php';
	}

function imprimer()
{
window.print(); 

}
function voire_cmd_pre()
{
	var height = 420;
 var width = 750;
 var top = (screen.height-height)/2;
 var left = (screen.width-width)/2;
 window.open("voir_cmd_pre.php", "form_mod", "toolbar=no, location=no, directories=no, status=yes, scrollbars=yes,     resizable=no, width="+width+", height="+height+", left="+left+", top="+top);
	}
	
function sauv_word_cmd_pre()
{
	document.location='sauver_wx_list_cmd_pre.php';

	}