<?php 
$theme=$_POST["D1"];
mysql_connect("localhost","root","");
mysql_select_db("bd123456");
$d=date("Y-m-d");
$req="select * from sondage where now() > DateDebut and NumS='$theme'";
$res=mysql_query($req);
if(mysql_num_rows($res)<1) echo "Sondage non encore lancé!";
else 
{
	$req1="select * from reponse where NumS='$theme'";
	$res1=mysql_query($req1);
	if(mysql_num_rows($res1)<1) echo "Aucune participation enregistrée à ce moment";
	else 
	{
		$tot=mysql_num_rows($res1);
		$req2="select * from reponse R, participant P where NumS='$theme' and genre='F' and P.idparticipant= R.idparticipant";
		$res2=mysql_query($req2);
		$totf=mysql_num_rows($res2);
		$req3="select * from reponse R, participant P  where NumS='$theme' and genre='M'and P.idparticipant= R.idparticipant";
		$res3=mysql_query($req3);
		$toth=mysql_num_rows($res3);
		?>
		<body>

<p align="center"><b>Statistique du sondage</b></p>
<p><b>Nombre total des participants au sondage: <?php echo $tot ;?></b></p>
<p><b>Nombre des femmes:<?php echo $totf ;?></b></p>
<p><b>Nombre des hommes:<?php echo $toth ;?></b></p>
<table border="1" width="100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="3">
		<p align="center"><b>Pourcentages</b></td>
	</tr>
	<tr>
		<td><b>N°</b></td>
		<td><b>Question</b></td>
		<td><b>Oui</b></td>
		<td><b>Non</b></td>
		<td><b>Sans avis</b></td>
	</tr>
	<?php 
		$req4="select * from Question where NumS='$theme'";
		$res4=mysql_query($req4);
		$x=mysql_num_rows($res4);
		for($i=1;$i<=$x;$i++)
		{
			
			$req5="select * from reponse where NumQ=$i and NumS=$theme and rep='O'";
			$res5=mysql_query($req5);
			$oui=mysql_num_rows($res5);
			$req6="select * from reponse where NumQ=$i and NumS=$theme and rep='N'";
			$res6=mysql_query($req6);
			$non=mysql_num_rows($res6);
			$req7="select * from reponse where NumQ=$i and NumS=$theme and rep='S'";
			$res7=mysql_query($req7);
			$sa=mysql_num_rows($res7);
			$req8="select * from Question where NumS='$theme' and NumQ=$i";
			$res8=mysql_query($req8);
			$t=mysql_fetch_array($res8);
			$totrep=$oui+$non+$sa;
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $t["Contenu"]; ?></td>
		<td><?php echo (round($oui/$totrep,4)*100) ?>%</td>
		<td><?php echo (round($non/$totrep,4)*100) ?>%</td>
		<td><?php echo (round($sa/$totrep,4)*100) ?>%</td>
	</tr>
		<?php } ?>
</table>
<p>&nbsp;</p>

</body>
		
		
		
		<?php
	}
	
}
mysql_close();
?>