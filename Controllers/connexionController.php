<?php
session_start();

if(isset($_SESSION['client']))
{
	if(isset($_GET['end']))
	{
		session_destroy();
		return false;
	}
	else{
		echo 'CONNECTE';
	}
}
else
{
	echo 'DECONNECTE';
}
?>