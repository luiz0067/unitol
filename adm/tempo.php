<?php 
	ob_start();
	session_start();
	$tempo=((10*60)-(time()-$_SESSION['meu_tempo']));

	$minuto = intval($tempo/60);
	$segundos = $tempo % 60;	
		//$minuto=($minuto-10)*-1
	if(strlen($segundos)==1)
		$segundos="0".$segundos;
	if(strlen($minuto)==1)
		$minuto="0".$minuto;
	echo $minuto.":".$segundos;
?>