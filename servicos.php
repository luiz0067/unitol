<div class="row" style="height:auto;min-height:100px;" id="conteudo_geral">
	<div class="mapadepercurso">
	  <div class="branco" style="width:18px; height:auto;min-height:50px; float:left;"></div>
		<div class="branco" style="width:882px; height:auto;min-height:50px; float:left;">
		  <a style="color:#F00; font-size:10px; font-family:century;">MAPA DE PERCURSO</a><br>
		  <a style="color:#000; font-size:10px; font-family:century;">Você está em: Home > Serviços</a><br>
		</div>
	</div>
	<div class="center" style="height:auto;min-height:44px;">
		<div class="branco" style="width:18px; height:auto;min-height:44px; float:left"></div>
		<div class="h1" style="width:482px; height:auto;min-height:44px; float:left; font-family:century; font-size:29px; text-align:left;">Conheça nossos serviços</div>
		<div class="branco" style="width:400px; height:auto;min-height:44px; float:left;"></div>
	</div>
	<div  class="center" style="height:auto;min-height:auto;">
		<div class="center" style="height:auto;min-height:auto">
			<div class="preto" style="width:900px; height:auto;min-height:4px; clear:both; background-image:url(imagens/servicos/linhadivisoria.gif); background-repeat:repeat-x;"></div>
			<?php 
				$sql    = "SELECT * FROM servicos s order by titulo asc;	";
				$result = mysql_query($sql, $link);
				if ($result!=null) 
				while ($row = mysql_fetch_assoc($result))
				{
			?>
		  <div class="linhaservicos">
			<div class="branco" style="width:18px; height:auto;min-height:100px; float:left;"></div>
			<div class="fotoservico"><img src="../upload/servicos/g_<?php echo $row['imagem'];?>" width="120" height="70"  /></div>
			<div class="branco" style="width:732px; height:auto;min-height:100px; float:left; font-family:century; font-size:14px; text-align:left; padding:">
				<div class="branco" style="width:18px; height:auto;min-height:100px; float:left;"></div><br><a style="color:#F00; font-size:18px;"><?php echo $row['titulo'];?></a> <br> 
					<?php echo $row['descricao'];?>
			</div>
			<div class="preto" style="width:900px; height:auto;min-height:4px; clear:both; background-image:url(imagens/servicos/linhadivisoria.gif); background-repeat:repeat-x;"></div>
		  </div>	
		  <?php } ?>
		</div>
	</div>
	<div  class="center" style="height:auto;min-height:132px;"></div>
</div>			