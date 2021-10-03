<?php
//servicos_prestados
include('cabecalho.php');
$row=null;
$result=null;
$imagemt=null;
$imagem_antigat=null;

function redimensiona($origem,$destino,$maxlargura,$maxaltura,$qualidade){
	
	list($largura, $altura) = getimagesize($origem);
	if($altura>$largura){
		$diferenca=$altura/$maxaltura;
		$maxlargura=$largura/$diferenca;
	}
	else{
		$diferenca=$largura/$maxlargura;
		$maxaltura=$altura/$diferenca;
	}
	$image_p = ImageCreateTrueColor($maxlargura,$maxaltura)	or die("Cannot Initialize new GD image stream");	
	$origem = imagecreatefromjpeg($origem);
	imagecopyresampled($image_p, $origem, 0, 0, 0, 0,  $maxlargura, $maxaltura, $largura, $altura);
	imagejpeg($image_p, $destino, $qualidade);
	imagedestroy($image_p);
	imagedestroy($origem);
} 
if (isset($_GET["codigo"])){
	$sql	= "SELECT codigo,imagem,titulo,descricao FROM servicos where (codigo=0".$_GET["codigo"].")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if ($result!=null)
		$imagem_antiga=$row["imagem"];
	
}
?>
<center>
<div style="height:100px;display:block;">
<?php
if ($_POST) {
	$folder = "../upload/servicos/";
	if (
		(
			($_FILES["imagem"]["type"] == "image/gif")
			|| 
			($_FILES["imagem"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/pjpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/png")
			|| 
			($_FILES["imagem"]["type"] == "image/bmp")
		)
	)
	{
		if (($_FILES["imagem"]["size"] < 1024*1024)){
			if ($_FILES["imagem"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem"]["error"] . "<br />";
			}
			else
			{
				//echo "Upload: " . $_FILES["imagem"]["name"] . "<br />";
				//echo "Tipo: " . $_FILES["imagem"]["type"] . "<br />";
				//echo "Tamanho: " . ($_FILES["imagem"]["size"] / 1024) . " Kb<br />";
				//echo "Temp file: " . $_FILES["imagem"]["tmp_name"] . "<br />";
				$imagem=$_FILES["imagem"]["name"];
				$acc=explode(".", $imagem);
				$extension=strtolower(end($acc));
				if (file_exists($folder . $imagem))
				{
					$imagem=time().".".$extension;
					move_uploaded_file(
						$_FILES["imagem"]["tmp_name"],
						$folder . $imagem
					);
				}
				else
				{
					move_uploaded_file(
						$_FILES["imagem"]["tmp_name"],
						$folder . $imagem
					);
					
				}
				redimensiona($folder . $imagem,$folder."h_".$imagem,800,600,75);
				redimensiona($folder . $imagem,$folder."g_".$imagem,224,230,75);
				redimensiona($folder . $imagem,$folder."m_".$imagem,80,80,75);
				redimensiona($folder . $imagem,$folder."p_".$imagem,32,32,75);
				unlink($folder . $imagem);
				//delete_file($folder . $imagem);	
				echo "<a href=\"../upload/imagens/p_".$imagem."\" target=\"blank\">".$imagem."</a><br>";
					
			}
		}
		else
	{
		echo "Tamanho muito grande<br>";
	}
	}
	else
	{
		$imagem=$imagem_antiga;
	}

	
	if (isset($_POST["acao"])){
		$acao=$_POST["acao"];
	}
	else
		$acao="";
	
	if (isset($_POST["titulo"])){
		$titulo=$_POST["titulo"];
	}
	else
		$titulo="";
		
	if (isset($_POST["descricao"])){
		$descricao=$_POST["descricao"];
	}
	else
		$descricao="";
		
	if (isset($_GET["codigo"])){
		$codigo=$_GET["codigo"];
	}
	else if (isset($_POST["codigo"])){
		$codigo=$_POST["codigo"];
	}
	else
		$codigo="";
	
	if ($acao=='alterar'){
		if ($imagem==null){
			$sql = "update servicos set  titulo='".$titulo."',descricao='".$descricao."' where (codigo=0".$codigo.");";
			mysql_query($sql, $link);
		}
		else{
			$sql = "update servicos set imagem='".$imagem."', titulo='".$titulo."',descricao='".$descricao."' where (codigo=0".$codigo.");";
			mysql_query($sql, $link);
			
			if (isset($imagem_antiga)){
				$acc=$folder ."p_".$imagem_antiga;
				if (file_exists($acc))
					unlink($acc);
				$acc=$folder ."m_".$imagem_antiga;
				if (file_exists($acc))
					unlink($acc);
				$acc=$folder ."g_".$imagem_antiga;
				if (file_exists($acc))
					unlink($acc);
				$acc=$folder ."h_".$imagem_antiga;
				if (file_exists($acc))
					unlink($acc);
			}
		}
	}
	else if( $acao=='inserir'){
		$sql = "insert into servicos (imagem, titulo, descricao) values ('".$imagem."','".$titulo."','".$descricao."');";
		//echo $sql;
		mysql_query($sql, $link);
	}
	else if ($acao=='excluir'){
		//delete_file($folder . $imagem_antiga);
		$sql = 'delete FROM servicos where codigo=0'.$codigo;
		//echo $sql;
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
	<form  method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table >
			<tr>
				<td>codigo:</td>
				<td><input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
			</tr>
			<tr>
				<td>imagem:</td>
				<td><input name="imagem" type="file" ></td>
			</tr>
			<tr>
				<td>titulo:</td>
				<td><input name="titulo" type="text" value="<?php if ($result!=null) echo $row["titulo"]?>"></td>
			</tr>
			<tr>
				<td>descricao:</td>
				<td><textarea name="descricao" ><?php if ($result!=null) echo $row["descricao"]?></textarea></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="alterar">
					<input type="submit" name="acao" value="excluir">
					<input type="button" value="limpar" onclick="self.location.href='?codigo'">	
				</td>
			</tr>
		</table>
	</form>
			<table border="1">
			
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = "SELECT * FROM servicos s order by titulo asc;	";
			$result = mysql_query($sql, $link);
			$i=0;
			if ($result!=null) 
			while ($row = mysql_fetch_assoc($result)){
			if($i==0){
			?>
			<tr bgcolor="#DDDDDD">
				<td>Codigo</td>
				<td>titulo</td>
				<td>Descricao</td>
			</tr>
			<?php
			}
			$i++;
		?>
			
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td>
						<?php if($row['imagem']!=""){?>
						<?php echo $row['titulo'];?><br>
						<a href="../upload/servicos/h_<?php echo $row['imagem'];?>" target="_blank">ampliar<a/><br>
						<img width="100px" height="100PX" src="../upload/servicos/g_<?php echo $row['imagem'];?>">
						<?php }
						else{
						?>
						&nbsp;
						<?php }?>
					</td>
					<td><?php echo $row['descricao'];?>&nbsp; </td>
				</tr>
			<?php
				}
				mysql_free_result($result);
			?>
			</table>
			</center>
<?php
	include('rodape.php');
?>
