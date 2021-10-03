<?php
	ob_start();
	$minutos=10;
	session_start();
	echo "Bem vindo ".$_SESSION["usuario"];	
	include('conecta.php');
	$row_verifica=null;
	$result_verifica=null;
	$sql    = "SELECT * FROM usuario where (codigo=0".$_SESSION["codigo_usuario"].") ;";
	//echo $sql;
	$result_verifica=mysql_query($sql, $link);
	if (
		($result_verifica!=null)
		&&
		($_SESSION["codigo_usuario"]!=null)
		&&
		((time()-$_SESSION['meu_tempo'])<($minutos*60))
	)
	{
		$row_verifica = mysql_fetch_assoc($result_verifica);
		$_SESSION["codigo_usuario"]		= $row_verifica["codigo"];
		$_SESSION["usuario"]	= $row_verifica["usuario"];	
		$_SESSION['meu_tempo'] 	= time();
		//smysql_free_result($row_verifica);
	}
	else{
		$_SESSION['meu_tempo']=time();
		?>
		<script type="text/javascript">
			self.location.href="./logout.php"
			//alert("<?php echo ($_SESSION["codigo_usuario"]);?>")
		</script>
		<?php
	}
?>		