<HTML>
<TITLE>Demande de renseignements</TITLE>
<meta HTTP-EQUIV="Refresh" CONTENT="2;URL=http://www.cev-treuil.com/">
<link href="texte.css" rel="stylesheet" type="text/css">
<BODY BGCOLOR="#FFFFFF" LINK="#FFFF99" ALINK="#00FF00" VLINK="#FFFF00">
<?php
$societe  = $_POST['societe'];
$nom      = $_POST['nom'];
$prenom   = $_POST['prenom'];
$adresse1 = $_POST['adresse1'];
$adresse2 = $_POST['adresse2'];
$cp       = $_POST['cp'];
$ville    = $_POST['ville'];
$tel      = $_POST['tel'];
$fax      = $_POST['fax'];
$email    = $_POST['email'];

$trelechal  = $_POST['trelechal'];
$treleclev  = $_POST['treleclev'];
$trhydhal   = $_POST['trhydhal'];
$trhydlev   = $_POST['trhydlev'];
$trman      = $_POST['trman'];
$trveh      = $_POST['trveh'];
$plateau    = $_POST['plateau'];
$dep        = $_POST['dep'];
$bras       = $_POST['bras'];
$acc        = $_POST['acc'];
$cable      = $_POST['cable'];
$infos      = $_POST['infos'];



$contenu='';
$contenu .= 'Société: '.$societe."\n";
$contenu .= 'Nom: '.$nom."\n";
$contenu .= 'Prénom: '.$prenom."\n";
$contenu .= 'Adresse: '.$adresse1."\n".$adresse2."\n".$cp.'  '.$ville."\n";
$contenu .= 'Tél.: '.$tel."\n";
$contenu .= 'Fax: '.$fax."\n";
$contenu .= 'Mail: '.$email."\n";

/*
$checkbox[]='trelechal';
$checkbox[]='treleclev';
$checkbox[]='trhydhal';
$checkbox[]='trhydlev';
$checkbox[]='trman';
$checkbox[]='trveh';
$checkbox[]='plateau';
$checkbox[]='';
*/

$contenu .="\n Je suis interessé par : \n";

if ($trelechal=='oui')  $contenu.="-Treuils électriques de halage\n";
if ($treleclev=='oui')  $contenu.="-Treuils électriques de levage\n";
if ($trhydhal=='oui')   $contenu.="-Treuils hydrauliques de halage\n";
if ($trhydlev=='oui')   $contenu.="-Treuils hydrauliques de levage\n";
if ($trman=='oui')      $contenu.="-Treuils manuels\n";
if ($trveh=='oui')      $contenu.="-Montage de treuils sur véhicules\n";
if ($plateau=='oui')    $contenu.="-Plateau porte-voiture\n";
if ($dep=='oui')        $contenu.="-Equipement de dépannage poids-lourds\n";
if ($bras=='oui')       $contenu.="-Bras de remorquage\n";
if ($acc=='oui')        $contenu.="-Accessoires\n";
if ($cable=='oui')      $contenu.="-Matériel de pose de câbles\n";
if ($infos!='')         $contenu.="\nDemande d'information complémentaire:\n".$infos."\n";

mail('commercial@cev-treuil.com','Demande d\'informations', utf8_decode($contenu)); 
?>

<table width="100%" border="0" height="112">
  <tr> 
    <td colspan="2" height="70"> <h1 align="center"><font face="Georgia, Times New Roman, Times, serif" color="#0000FF" size="+4"><img src="images/logo180.jpg" width="180" height="77"></font></h1></td>
    <td colspan="2" bgcolor="#000000" height="50" align="center" valign="middle"><b><font size="5" color="#FFFFFF">Une 
      gamme compl&egrave;te de treuils et d'&eacute;quipement de d&eacute;pannage 
      routier</font></b></td>
  </tr>
  <tr> </tr>
  <tr bgcolor="#CC3300"> 
    <td width="22%" height="7"> <div align="center"><b><font color="#FFFFFF"><a href="societe.html">La 
        soci&eacute;t&eacute;</a></font></b></div></td>
    <td width="20%" height="7"> <div align="center"><b><font color="#FFFFFF"><a href="actualite.htm">Actualit&eacute;s</a></font></b></div></td>
    <td width="34%" height="7"> <div align="center"><b><font color="#FFFFFF"><a href="index.htm">Sommaire</a></font></b></div></td>
    <td width="24%" height="7"> <div align="center"><b><a href="mailto:cev@club-internet.fr">Contactez-nous</a></b></div></td>
  </tr>
</table>
<TABLE  WIDTH="100%" BORDER="0" VSPACE="0" HSPACE="0" CELLPADDING="4" CELLSPACING="0" bgcolor="#E0E0E0">
  <TR>
    <TD ALIGN="left" BGCOLOR="#333399"> 
      <div align="center"><FONT FACE="Arial, Helvetica, sans-serif" SIZE="4" COLOR="#FFFFFF"><B>Demande 
        d'informations compl&eacute;mentaires</B></FONT></div>
    </TD>
  </TR>
</TABLE>
<HR WIDTH="100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
<p class="entete">&nbsp;</p>
      <p class="entete"><strong><font size="2" face="Arial, Helvetica, sans-serif">Votre 
        demande nous a &eacute;t&eacute; transmise.</font></strong></p>
      <p class="entete"><strong><font size="2" face="Arial, Helvetica, sans-serif">Nous 
        allons y apporter toute notre attention.</font></strong></p>
</td>
  </tr>
</table>
</BODY></HTML>

