function alphanum(ch)
{
	var i=0;
	var ch1=ch.toUpperCase();
	while(((ch1.charAt(i) >='A') &&(ch1.charAt(i)<='Z')) ||
	((ch1.charAt(i) >='0') &&(ch1.charAt(i)<='9')) &&(i<ch1.length))
	{
		i++;
	}
	return (i==ch1.length)&&(ch1.length>2);
}
function lettre(ch)
{
	var i=0;
	var ch1=ch.toUpperCase();
	while((ch1.charAt(i) >='A') &&(ch1.charAt(i)<='Z')) i++;
	return ((i==ch1.length)&&(ch1.length>=2)&&(ch1.length<=4));
}
function test()
{
mail=document.f.T1.value;
mdp=document.f.T2.value;
if((mail.length>50)||(mail.indexOf('@')==-1)||(mail.indexOf('.')==-1))
{
	alert('Format mail invalide');
	return false;
}
else 
{
	a=mail.indexOf('@');
	b=mail.indexOf('.');
	ch1=mail.substr(0,a);
	ch2=mail.substr(a+1,b-(a+1));
	ch3=mail.substr(b+1);
	if(!alphanum(ch1) || !alphanum(ch2) || !lettre(ch3))
	{
		alert("saisie de mail invalide");
		return false;
	}
	
}
maj=0;
chiff=0;
mini=0;
for(i=0;i<mdp.length;i++)
{
	if((mdp.charAt(i)>='A') && (mdp.charAt(i)<='Z')) maj++;
	else if ((mdp.charAt(i)>='a') && (mdp.charAt(i)<='z')) mini++;
	else if((mdp.charAt(i)>='0') && (mdp.charAt(i)<='9')) chiff++;
}
if((maj==0)||(mini==0)||(chiff==0)||mdp.length<6)
{
	alert('mot de passe invalide');
	return false;
}else
if(document.f.D1.options.selectedIndex<1)
{
	alert('il faut sélectionner une option');
	return false;
}
if(!document.f.R1[0].checked && !document.f.R1[1].checked && !document.f.R1[2].checked)
{
		alert('il faut cocher une option pour la première question');
		return false;
}
if(!document.f.R2[0].checked && !document.f.R2[1].checked && !document.f.R2[2].checked)
{
		alert('il faut cocher une option pour la deuxième question');
		return false;
}
if(!document.f.R3[0].checked && !document.f.R3[1].checked && !document.f.R3[2].checked)
{
		alert('il faut cocher une option pour la troisième question');
		return false;
}
}






