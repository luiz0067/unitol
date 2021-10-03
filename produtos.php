<?php
	$imagem="";
	$descricao="";
	$nome="";
	$catnome="";
	$cat="";
	$row ="";
	if (isset($_GET["codigo"]))
		$codigo=$_GET ['codigo'];
	else
		$codigo="";
		
			
	if ((isset($_GET["cat"]))&&($_GET["cat"]!=""))
		$cat=$_GET['cat'];
	else {					
		$sql	= "SELECT codigo,nome FROM categoria ORDER BY NOME ASC";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
		$cat=$row['codigo'];
		$catnome=$row['nome'];
	}
	
	$sql = "SELECT produtos.codigo,produtos.nome,produtos.descricao,produtos.categoria as codigo_categoria,categoria.nome as categoria_nome FROM produtos left join categoria on(produtos.categoria=categoria.codigo) where(produtos.categoria=0".$cat.") order by nome asc;";
	if($codigo!="")
		$sql="SELECT produtos.codigo,produtos.nome,produtos.descricao,produtos.categoria as codigo_categoria,categoria.nome as categoria_nome FROM produtos left join categoria on(produtos.categoria=categoria.codigo) where(produtos.categoria=0".$cat.")and(produtos.codigo=0".$codigo.");";
	$result = mysql_query($sql,$link);
	if (($result!=null)&&(true)){
		$row = mysql_fetch_assoc($result);
		$cat=$row['codigo_categoria'];
		$catnome=$row['categoria_nome'];
		$nome=$row["nome"];
		$descricao=$row["descricao"];
	}
	//echo $sql;
?>

<div class="row" style="height:auto;min-height:367px;">
	<div class="mapadepercurso">
	  <div class="branco" style="width:18px; height:auto;min-height:50px; float:left;"></div>
		<div class="branco" style="width:882px; height:auto;min-height:50px; float:left;">
		  <a style="color:#F00; font-size:10px; font-family:century;">MAPA DE PERCURSO</a><br>
		  <a style="color:#000; font-size:10px; font-family:century;">Você está em: Home >  Produtos > <?php echo $catnome;?></a><br>
		</div>
	</div>
	<div class="center" style="height:auto;min-height:50px;">
		<div class="branco" style="width:18px; height:auto;min-height:50px; float:left"></div>
		<div class="h1" style="width:200px; height:auto;min-height:50px; float:left; font-family:century; font-size:29px; text-align:left;">Produtos<br><a style="font-family:century; font-size:10px; color:#F00; text-align:left;">SOLICITE UM ORÇAMENTO</a></div>
		<div class="branco" style="width:682px; height:auto;min-height:50px; float:left;"></div>
	</div>&nbsp;
	<div  class="center" style="height:auto;min-height:317px;">
		<div class="center" style="height:auto;min-height:317px">
		  <div class="branco" style="width:18px; float:left;height:auto;min-height:317px;"></div>
		  <div class="branco" style="width:882px; height:auto;min-height:317px; float:left;">
			<div class="branco" style="width:611px; height:auto;min-height:303px; padding:7px; float:left; background-color:#FFF;">
				<div id="produtogrande">
				
				<?php
										
					
					
					$i=0;
					if (($result!=null)&&(true)){
						$sql_fotos    = "SELECT codigo,imagem,nome,produto FROM fotos where (produto=0".$row["codigo"].") order by codigo desc";
						$codigo=$row["codigo"];
						$result_fotos = mysql_query($sql_fotos, $link);
						while($row_fotos = mysql_fetch_assoc($result_fotos)){
							$imagem=$row_fotos["imagem"];
							$foto_nome=$row_fotos["nome"];
							if ($i>0){								
							?>
								<a  href="./upload/imagens/h_<?php echo $imagem;?>" rel="lightbox[roadtrip]" border="0px"  ><img src="./upload/imagens/g_<?php echo $imagem;?>"   style="display:none" border="0px" /></a>
							<?php 
							}
							else{
							?>
								<a href="./upload/imagens/h_<?php echo $imagem;?>" rel="lightbox[roadtrip]" border="0px"  ><img id="ampliar" src="./upload/imagens/g_<?php echo $imagem;?>"  border="0px" /></a>
							<?php 
							}
						$i++;
						}
					} ?>

				</div>
				<div class="branco" style="width:365px; height:auto;min-height:20px; height:auto;min-height:256px; float:left;">
					<div style="clear:both;color:#000; font-size:16px; font-family:century;">Categoria: <?php echo $catnome;?></div>
					<div style="clear:both;text-indent:20px;float:left;color:#000; font-size:14px; font-family:century;">Nome: <?php echo $nome;?></div>
					<div style=" clear:both;text-indent:20px;float:left;color:#000; font-size:14px; font-family:century;height:auto;overflow:auto;"><?php echo $descricao;?></div>
					<div style=" clear:both;text-indent:20px;float:left;color:#000; font-size:14px; font-family:century;height:auto;overflow:auto;" id="detalhes_foto"><?php echo $foto_nome;?></div>
				</div>
				<div class="branco" style="width:611px; height:auto;min-height:47px; background-color:blank;">
					<div class="branco" style="width:15px; height:auto;min-height:44px;"></div>					
					<?php
						$sql    = "SELECT codigo,imagem,nome,produto FROM fotos where (produto=0".$row["codigo"].") order by codigo desc";
						$result_fotos = mysql_query($sql, $link);
						
						if(isset($imagem))
						if(($result_fotos!=null)&&(true))
						while($row_fotos = mysql_fetch_assoc($result_fotos)){
							$imagem=$row_fotos["imagem"];
							$nome=$row_fotos["nome"];
					?>
					<div class="produtopequeno"><img onclick="trocar_foto(this)" src="./upload/imagens/p_<?php echo $imagem;?>" height="44" name="<?php echo $nome;?>"/></div>
					<?php } ?>
				</div>
			</div>
			<div class="branco" style="width:11px; height:auto;min-height:317px; float:left;"></div>
			<div class="branco" style="width:246px; height:auto;min-height:317px; float:left;">
				<div class="branco" style="width:246px; height:auto;min-height:144px; float:left; background-color:#00AFEF; text-align:center; font-family:century; 
				color:#FFF; font-size:18px; font-weight:bold;"><br>Entre em contato com<br>nossa loja:<br><br>45. 3278-1720</div>
				<div class="branco" style="width:246px; height:auto;min-height:173px; float:left; background-color:transparent;"></div>
			</div>

		  </div>
	   </div>
	</div>
	<div class="row" style="height:9px;"></div>
	<div class="row" style="background-color:#BDBDBD;height:9px;"></div>
	<div class="row" style="background-color:#BDBDBD;height:165px;">
		<div  class="center" style="height:auto;min-height:132px;background-color:#BDBDBD;overflow:hidden;" id="rolagem">
			<div class="botao_esquerda" onclick="anterior();" style="position:absolute;margin-top:50px;z-index:20;"></div>
			<div class="botao_direita" onclick="proximo();" style="position:absolute;margin-top:50px;z-index:20;margin-left:850px;"></div>

			<div style="height:107px;width:30000px" >
			<?php
				$sql = "SELECT produtos.codigo,produtos.nome,produtos.descricao,produtos.categoria as codigo_categoria,categoria.nome as categoria_nome FROM produtos left join categoria on(produtos.categoria=categoria.codigo) where(produtos.categoria=0".$cat.") order by produtos.nome asc;";
				$result = mysql_query($sql, $link);
				while ($row = mysql_fetch_assoc($result)) {				
					$sql_fotos    = "SELECT codigo,imagem,nome,produto FROM fotos where (produto=0".$row["codigo"].")and(produto!=0".$codigo.") order by codigo desc";
					$descricao=$row["descricao"];
					$result_fotos = mysql_query($sql_fotos, $link);
					if($row_fotos = mysql_fetch_assoc($result_fotos)){
						$imagem=$row_fotos["imagem"];
			?> 
					
					<div class="fotos_pequenas"><a href="?pg=produtos&cat=<?php echo $cat;?>&codigo=<?php echo $row["codigo"]?>"><img src="./upload/imagens/m_<?php echo $imagem;?>" height="107"></a></div>	
					<div class="margem_fotos"></div>	
			<?php 				
					}
				}
			?>
								
							
			</div>
		</div>
	</div>
</div>