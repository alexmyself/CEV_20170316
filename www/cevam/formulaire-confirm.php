<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<? 
 $contenu=" Société : ".$societe."\n
Nom : ".$nom."\n
Prénom : ".$prenom."\n
Adresse : ".$adresse1."\n
               ".$adresse2."\n
               ".$cp." ".$ville."\n
Téléphone : ".$tel."\n
Fax : ".$fax."\n
E-mail : ".$email."\n\n
Je suis interessé(e) par : \n
 ";

if ($trelechal=='oui') $contenu=$contenu." - TL2019\n
";
if ($treleclev=='oui') $contenu=$contenu."  - TL3019\n
";
if ($trhydhal=='oui') $contenu=$contenu."  - TL3022\n
";
if ($trhydlev=='oui') $contenu=$contenu."  - Autre\n
";
if ($trman=='oui') $contenu=$contenu."  - Dérouleuses\n
";
if ($trveh=='oui') $contenu=$contenu."  - Matériels de portage\n
";
if ($plateau=='oui') $contenu=$contenu."  - Brins rigides\n
";
if ($dep=='oui') $contenu=$contenu."  - Galets de déroulage\n
";
if ($bras=='oui') $contenu=$contenu."  - Chaussettes tire câbles\n
";
if ($acc=='oui') $contenu=$contenu."  - Furets et obturateurs\n
";
if ($cable=='oui') $contenu=$contenu."  - Autre\n
";
if ($infos!='') $contenu=$contenu."\nDemande d'information complémentaire : ".$infos."\n
";

mail("commercial@cev-treuil.com","Demande d'informations","$contenu"); 
?>
<table width="100%" border="0" height="112">
  <tr> 
    <td colspan="2" height="70"> 
      <h1 align="center"><img src="images/Logo%20Cevam.jpg" width="302" height="60"></h1>
    </td>
    <td colspan="2" bgcolor="#000000" height="50" align="center" valign="middle"><b><font size="5" color="#FFFFFF">Mat&eacute;riels 
      pour la pose de c&acirc;bles</font></b></td>
  </tr>
  <tr> </tr>
  <tr bgcolor="#CC3300"> 
    <td width="22%" height="7"> 
      <div align="center"><b><font color="#FFFFFF"><a href="societe.html">La soci&eacute;t&eacute;</a></font></b></div>
    </td>
    <td width="20%" height="7"> 
      <div align="center"><b><font color="#FFFFFF"><a href="actualite.htm">Actualit&eacute;s</a></font></b></div>
    </td>
    <td width="34%" height="7"> 
      <div align="center"><b><font color="#FFFFFF"><a href="index.htm">Sommaire</a></font></b></div>
    </td>
    <td width="24%" height="7"> 
      <div align="center"><b><a href="mailto:cev@club-internet.fr">Contactez-nous</a></b></div>
    </td>
  </tr>
</table>
<table  width="100%" border="0" vspace="0" hspace="0" cellpadding="4" cellspacing="0" bgcolor="#E0E0E0">
  <tr> 
    <td align="left" bgcolor="#333399"> 
      <div align="center"><font face="Arial, Helvetica, sans-serif" size="4" color="#FFFFFF"><b>Demande 
        d'informations compl&eacute;mentaires</b></font></div>
    </td>
  </tr>
</table>
<hr width="100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="56">
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
</body>
</html>
