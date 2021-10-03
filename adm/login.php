<?php
	ob_start();
	include('conecta.php');
	$phpver = phpversion(); 
	if ($phpver >= '4.0.4pl1') { 
		if (extension_loaded('zlib')) { 
			ob_end_clean(); 
			ob_start('ob_gzhandler'); 
		} 
	} 
	$row_verifica=null;
	$result_verifica=null;
	if (isset($_POST["usuario"]))
		$usuario=$_POST["usuario"];
	else
		$usuario="";
		
	if (isset($_POST["senha"]))
		$senha=$_POST["senha"];
	else
		$senha="";
		
	$sql	= "SELECT codigo,usuario,senha FROM usuario where (usuario='".$usuario."') and( senha='".$senha."')";
	$result_verifica=mysql_query($sql, $link);
	if (($result_verifica!=null)&&($usuario!=null)&&($senha!=null)){
		$row_verifica = mysql_fetch_assoc($result_verifica);
		if (($usuario==$row_verifica["usuario"])&&($senha==$row_verifica["senha"])){
			{
				echo "<!--";
				Header("Cache-control: private, no-cache");
				Header("Expires: Mon, 26 Jun 1997 05:00:00 GMT");
				Header("Pragma: no-cache");
				session_unset();
				session_start();
				echo "-->";
			}
			$_SESSION["codigo_usuario"]		= $row_verifica["codigo"];
			$_SESSION["usuario"]	= $row_verifica["usuario"];
			$_SESSION['meu_tempo']     = time();
			//header("location:principal.php");
			echo "<script>location.href='principal.php';</script>";
			//echo "<a href='principal.php'>principal ".$_SESSION["usuario"]." </a>";
			//echo "<a href='verifica.php'>verifica.php ".$_SESSION["usuario"]." </a>";
			//echo $_SESSION["codigo"];
		}
		else{
			?>
			<div style="color:#FF0000">Usuario ou senha inválido</div>
			<?php
		
			//mysql_free_result($result);
		}
	}
	
?>
<html>
	<head>
	<script type="text/javascript">
	</script>
	<style type="text/css">
	</style>
	</head>
	<body>
		<center>
			<form method="post">
				<table>
					<tr>
						<td>usuario:</td>
						<td><input type="text" name="usuario"></td>
					</tr>
					<tr>
						<td>senha:</td>
						<td><input type="password" name="senha"></td>
					</tr>
					<tr>
						<td><input type="submit" name="acao" value="ok"></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>