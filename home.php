<div class="row" style="height:auto;min-height:400px;" id="conteudo_geral">	
	<div class="row" style="height:126px;"></div>
	<div class="row" style="margin-top:23px;height:430px;z-index:-100">
		<div  class="center" style="height:430px;" style="z-index:-100"  >
			<object style="z-index:-100" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="900" height="430">
			  <param name="play" value="true" />
			  <param name="loop" value="true" />
			  <param name="movie" value="./flash/photo_slider.swf" />
			  <embed src="./flash/photo_slider.swf" quality="high" bgcolor="#ffffff" width="900" height="430" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
			  </embed>
			</object>					
		</div>
	</div>
	<div class="row" style="background-image:url(file:///C|/Users/Jhonathan/Desktop/site/imagens/linha.png);height:4px;overflow:hidden"></div>
	<div class="row" style="background-color:#BDBDBD;height:9px;"></div>
	<div class="row" style="background-color:#BDBDBD;height:165px;">
		<div  class="center" style="height:auto;min-height:132px;background-color:#BDBDBD;overflow:hidden;" id="rolagem">
			<div class="botao_esquerda" onclick="anterior();" style="position:absolute;margin-top:50px;z-index:20;"></div>
			<div class="botao_direita" onclick="proximo();" style="position:absolute;margin-top:50px;z-index:20;margin-left:850px;"></div>

			<div style="height:107px;width:30000px" >
			<?php
				$sql = "SELECT produtos.codigo,produtos.nome,produtos.descricao,produtos.categoria as codigo_categoria,categoria.nome as categoria_nome FROM produtos left join categoria on(produtos.categoria=categoria.codigo) order by produtos.codigo desc limit 0,10;";
				
				$result = mysql_query($sql, $link);
				while ($row = mysql_fetch_assoc($result)) {				
					$sql_fotos    = "SELECT codigo,imagem,nome,produto FROM fotos where (produto=0".$row["codigo"].") order by codigo desc";
					$descricao=$row["descricao"];
					$result_fotos = mysql_query($sql_fotos, $link);
					if($row_fotos = mysql_fetch_assoc($result_fotos)){
						$imagem=$row_fotos["imagem"];
			?> 
					<div class="fotos_pequenas" ><a href="?pg=produtos&cat=<?php echo $row["codigo_categoria"];?>&codigo=<?php echo $row["codigo"]?>"><img src="./upload/imagens/m_<?php echo $imagem;?>" height="107"></a></div>	
					<div class="margem_fotos"></div>	
			<?php 				
					}
				}
			?>
								
							
			</div>
		</div>
	</div>
</div>