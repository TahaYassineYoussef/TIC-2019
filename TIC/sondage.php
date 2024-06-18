<?php 
$mail=$_POST["T1"];
$mdp=$_POST["T2"];
$genre=$_POST["D1"];
$q1=$_POST["R1"];
$q2=$_POST["R2"];
$q3=$_POST["R3"];
$q1=substr($q1,1,1);
$q2=substr($q2,1,1);
$q3=substr($q3,1,1);
mysql_connect("localhost","root","");
mysql_select_db("bd123456");
$req="select * from participant where mail='$mail'";
$res=mysql_query($req);
if(mysql_num_rows($res)<1)
{
	$req1="insert into Participant values('','$mail','$mdp','$genre')";
	$res1=mysql_query($req1);
	if(mysql_affected_rows()>0) echo("Inscription");
	$id=mysql_insert_id();
	$req2="insert into reponse values(1,1,'$id','$q1'),(2,1,'$id','$q2'),(3,1,'$id','$q3');";
	$res2=mysql_query($req2);
	if(mysql_affected_rows()>1) echo " et participation au sondage effectuées avec succès";
}
else
{
	$req3="select * from participant where mail='$mail' and mdp='$mdp'";
	$res3=mysql_query($req3);
	if(mysql_num_rows($res3)<1)
	{
		echo "Erreur d'authentification";
	}
	else 
	{
		$t=mysql_fetch_array($res3);
		$id=$t["IdParticipant"];
		$req4="select * from reponse where NumS=1 and idparticipant='$id'";
		$res4=mysql_query($req4);
		if(mysql_num_rows($res4)<1)
		{
			$req5="insert into reponse values(1,1,'$id',$q1),(2,1,'$id',$q2),(3,1,'$id',$q3);";
			$res5=mysql_query($req5);
			if(mysql_affected_rows()>0) echo "Participation au sondage effectuée avec succès";
		}
		else 
		{
			$i=0;
			$req6="update reponse set rep='$q1' where Idparticipant=$id and NumQ=1 and NumS=1";
			$req7="update reponse set rep='$q2' where Idparticipant=$id and NumQ=2 and NumS=1";
			$req8="update reponse set rep='$q3' where Idparticipant=$id and NumQ=3 and NumS=1";
			$res6=mysql_query($req6); if(mysql_affected_rows()>0) $i++;
			$res7=mysql_query($req7); if(mysql_affected_rows()>0) $i++;
			$res8=mysql_query($req8); if(mysql_affected_rows()>0) $i++;
			if($i==3) echo "Mise à jour effectuée avec succès";
		}
	}
}
mysql_close();
?>







