<?php
include('cabecalho.php');
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
?>
<center>
<div style="height:100px;display:block;">
<?php
if ($_POST) {
	$folder = "../upload/album/";
	if (
		(
			($_FILES["imagem1"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem1"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem1"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem1"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem1"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem1"]["tmp_name"],
					$folder . "01.jpg"
				);				
				redimensiona($folder . $imagem,$folder."01.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}
	//image 01.jpg
	if (
		(
			($_FILES["imagem2"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem2"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem2"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem2"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem2"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem2"]["tmp_name"],
					$folder . "02.jpg"
				);				
				redimensiona($folder . $imagem,$folder."02.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}	
	//image 02.jpg
	if (
		(
			($_FILES["imagem3"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem3"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem3"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem3"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem3"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem3"]["tmp_name"],
					$folder . "03.jpg"
				);				
				redimensiona($folder . $imagem,$folder."03.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}
	//image 03.jpg
	if (
		(
			($_FILES["imagem4"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem4"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem4"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem4"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem4"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem4"]["tmp_name"],
					$folder . "04.jpg"
				);				
				redimensiona($folder . $imagem,$folder."04.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}	
	//image 04.jpg
	if (
		(
			($_FILES["imagem5"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem5"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem5"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem5"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem5"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem5"]["tmp_name"],
					$folder . "05.jpg"
				);				
				redimensiona($folder . $imagem,$folder."05.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}
	//image 05.jpg	
	if (
		(
			($_FILES["imagem6"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem6"]["type"] == "image/pjpeg")
		)
	)
	{
		if (($_FILES["imagem6"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem6"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem6"]["error"] . "<br />";
			}
			else
			{
				move_uploaded_file(
					$_FILES["imagem6"]["tmp_name"],
					$folder . "06.jpg"
				);				
				redimensiona($folder . $imagem,$folder."06.jpg",900,430,75);				
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}
	//image 06.jpg	
}
?>
</div>
	<form action="?produto=<?php echo $_GET["produto"]?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table >
			<tr>
				<td>imagem1:</td>
				<td><input name="imagem1" type="file"></td>
			</tr>
			<tr>
				<td>imagem2:</td>
				<td><input name="imagem2" type="file"></td>
			</tr>
			<tr>
				<td>imagem3:</td>
				<td><input name="imagem3" type="file"></td>
			</tr>
			<tr>
				<td>imagem4:</td>
				<td><input name="imagem4" type="file"></td>
			</tr>
			<tr>
				<td>imagem5:</td>
				<td><input name="imagem5" type="file"></td>
			</tr>
			<tr>
				<td>imagem6:</td>
				<td><input name="imagem6" type="file"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="atualizar">
				</td>
			</tr>
		</table>
	</form>
			
	<img width="900px" height="430PX" src="../upload/album/01.jpg"><br>
	<img width="900px" height="430PX" src="../upload/album/02.jpg"><br>
	<img width="900px" height="430PX" src="../upload/album/03.jpg"><br>
	<img width="900px" height="430PX" src="../upload/album/04.jpg"><br>
	<img width="900px" height="430PX" src="../upload/album/05.jpg"><br>
	<img width="900px" height="430PX" src="../upload/album/06.jpg"><br>
</center>	
<?php
	include('rodape.php');
?>
