<?php
include('cabecalho.php');
$imagem=null;
$folder = "../upload/imagens/";


$acc="";
$imagem_antiga=null;
//safe_mode = Off;
//safe_mode_gid = Off;
//safe_mode_include_dir = ;
//safe_mode_exec_dir = ;
//redimensiona as imagens matendo a proporcao
function redimensiona($origem,$destino,$maxlargura,$maxaltura,$qualidade){
	//if (file_exists($origem))
	{
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
} 
//zera as variaveis de consulta
$row=null;
$result=null;
//inicia a avalidacao do campos se eles forem nulos
if (isset($_POST["acao"]))
	$acao=$_POST ['acao'];
else
	$acao="";
	
if (isset($_POST["codigo"]))
	$codigo=$_POST ['codigo'];
else if (isset($_GET["codigo"]))
	$codigo=$_GET ['codigo'];
else
	$codigo="";
	
if (isset($_POST["produto"]))
	$produto=$_POST ['produto'];
else if (isset($_GET["produto"]))
	$produto=$_GET ['produto'];
else
	$produto="";

if (isset($_POST["nome"]))
	$nome=$_POST ['nome'];
else
	$nome="";	

//aqui agente busca os dados da ediçao	

if ($codigo!=null){
	$sql	= "SELECT codigo,imagem,nome,produto FROM fotos where (codigo=0".$codigo.")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if ($result!=null)
		$imagem_antiga=$row["imagem"];
	
}
?>
<center>
<div style="height:100px;display:block;">
<?php

if ($_POST) {//inicia processo de upload
	
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
		if (($_FILES["imagem"]["size"] < 5*1024*1024)){
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
				$imagem=time().".".$extension;
				if (
					(file_exists($folder.$imagem))
					||
					(file_exists($folder . "p_".$imagem))
					||
					(file_exists($folder . "m_".$imagem))
					||
					(file_exists($folder . "g_".$imagem))		
					||
					(file_exists($folder . "h_".$imagem))				
				)
				{
					$imagem=time().".".$extension;
					
				}
				echo $_FILES["imagem"]["tmp_name"];
				//if (file_exists($_FILES["imagem"]["tmp_name"]))
				{
					move_uploaded_file(
						$_FILES["imagem"]["tmp_name"],
						$folder . $imagem
					);
					//if 	(file_exists($folder . $imagem))
					{
						redimensiona($folder . $imagem,$folder."h_".$imagem,800,600,75);//redimenciona as imagens largura,altura.qualidade
						redimensiona($folder . $imagem,$folder."g_".$imagem,224,230,75);
						redimensiona($folder . $imagem,$folder."m_".$imagem,80,80,75);
						redimensiona($folder . $imagem,$folder."p_".$imagem,32,32,75);
						unlink($folder . $imagem);
						//delete_file($folder . $imagem);	
						echo "<a href=\"../upload/imagens/g_".$imagem."\" target=\"blank\">".$imagem."</a><br>";//mostra a miniatura da imagem em um link
					}	
				}
			}
		}
		
	}
	else if(isset($imagem_antinga))
	{
		$imagem=$imagem_antiga;
	}
	else
		$imagem=null;
		
	if ($acao=='alterar'){
		
		if ($imagem==null){
			$sql = "update fotos set  nome='".$nome."',produto=0".$produto." where (codigo=".$codigo.");";
			mysql_query($sql, $link);
		}
		else{
			$sql = "update fotos set imagem='".$imagem."', nome='".$nome."',produto='".$produto."' where (codigo=".$codigo.");";
			//echo $sql;
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
		$sql = "insert into fotos (imagem, nome, produto) values ('".$imagem."','".$nome."','".$produto."');";
		//echo $sql;
		mysql_query($sql, $link);
	}
	else if ($acao=='excluir'){
		//delete_file($folder . $imagem_antiga);
		$sql = 'delete FROM fotos where codigo='.$codigo;
		//echo $sql;
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
	<form action="?produto=<?php echo $produto?>" method="post" enctype="multipart/form-data" >
		<table >
			<tr>
				<td>codigo:</td>
				<td><input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
			</tr>
			<tr>
				<td>imagem:</td>
				<td><input name="imagem" type="file" ></td>
			</tr>
			<input name="produto" type="hidden" value="<?php echo $produto;?>">
			<tr>
				<td>nome:</td>
				<td><input name="nome" type="text" value="<?php if ($result!=null) echo $row["nome"]?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="alterar">
					<input type="submit" name="acao" value="excluir">
					<input type="button" value="limpar" onclick="self.location.href='?produto=<?php echo $produto?>'">	
				</td>
			</tr>
		</table>
	</form>
			<table border="1">
			
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = "SELECT f.codigo,f.imagem,f.nome,p.nome as produto,p.codigo as codigo_produto,p.Descricao,link FROM fotos f right join produtos p on (p.codigo=f.produto) where (p.codigo=0".$produto.");";
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			$i=0;
			while ($row = mysql_fetch_assoc($result)){
				if($i==0){
					?>
					<tr bgcolor="#DDDDDD">
						<td>Codigo Produto</td>
						<td>nome</td>
						<td>Descricao</td>
					</tr>
					<tr>
						<td><a href="./cadastro_produtos.php?codigo=<?php echo $row['codigo_produto'];?>"><?php echo $row['codigo_produto'];?><a/></td>
						<td><?php echo $row['produto'];?></td>
						<td><?php echo $row['Descricao'];?></td>
					</tr>
					<tr bgcolor="#DDDDDD">
						<td>codigo</td>
						<td>imagem</td>
						<td>nome</td>
					</tr>
					<?php
				}
			$i++;
		?>
			
				<tr>
					<td><a href="?produto=<?php echo $produto?>&codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td>
						<?php if($row['imagem']!=""){?>
						<a href="../upload/imagens/h_<?php echo $row['imagem'];?>" target="_blank">ampliar<a/><br>
						<img width="100px" height="100PX" src="../upload/imagens/g_<?php echo $row['imagem'];?>">
						<?php }
						else{
						?>
						&nbsp;
						<?php }?>
					</td>
					<td><?php echo $row['nome'];?>&nbsp </td>
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
