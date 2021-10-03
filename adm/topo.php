 <!--------------------------------------topo----------------------------------------------------->		  
<div class="row">
  <div class="row" style="height:107px;">
		<div  class="center" style="width:900px;height:107px;">
			<div class="branco" style="width:30px; height:107px; float:left;"></div>
			<div id="logo"><a href="?pg=home" style="text-decoration:none;"><img src="imagens/logo.png" width="257" height="107" border="0"/></a></div>
			<div style="width:613px;height:107px;float:left;">
				  <div class="branco" style="height:16px; width:613px; float:left;"></div>
				  <div id="div_bem_vindo" style="width:613px; float:left;">Bem-vindo á nossa loja online!</div>					
				  <div class="branco" style="clear:both; width:613px; height:50px; float:left;"></div>
				  <div id="div_menu_1">
					<a href="?pg=quemsomos" class="div_menu_1">Quem Somos</a> | 
					<a href="?pg=faleconosco" class="div_menu_1">Fale Conosco</a> | 
					<a href="?pg=atendimento" class="div_menu_1">Atendimento ao Cliente</a> 
				</div>					
			</div>					
		</div>
	</div>
	<div class="row" style="height:16px;" onmouseover="document.getElementById('menu_produto').style.display='none';"></div>
	<div class="row" style="height:45px;">
		<div id="risco_cinza" ></div>
		<div  class="center" id="div_menu_2">
			<div style="float:left;margin-top:8px;" >
				<div class="div_menu_2"><a href="?pg=home" class="div_menu_2">Home</a></div>
				<div class="div_menu_2"><a href="?pg=institucional" class="div_menu_2">Institucional</a></div>
				<div class="div_menu_2" onmouseover="document.getElementById('menu_produto').style.display='none';"><a href="?pg=servicos" class="div_menu_2">Serviços</a></div>
				<div class="div_menu_2"  onmouseover="document.getElementById('menu_produto').style.display='block';">Produtos
					<?php 
					
						$sql    = "SELECT codigo,nome FROM categoria order by nome asc";
						$result = mysql_query($sql, $link);
						$total=mySQL_num_rows($result);
						$colunas=1;
						if($total%5>0)
							$colunas=(($total-($total%5))/5)+1;
						else
							$colunas=($total/5);
					?>
					<div id="menu_produto"  onmouseout="document.getElementById('menu_produto').style.display='none';">
						<div style="width:<?php echo ($colunas*120)?>px; height:34px;clear:both;background-color:#333333;">
							<div class="center"  style="width:50px; height:34px;"><img src="./imagens/logomenu.gif" height="34" width="50"></div>
						</div>
						<div style="width:<?php echo ($colunas*100)?>px; height:126px; clear:both; float:left;display:block;">
							<div style="width:90px; height:126px; float:left; text-align:left; padding-left:7px; font-size:14px; color:#FFF;display:block;">
								<br>
								<?php 
									$i=0;
									if ($result!=null)
										while ($row = mysql_fetch_assoc($result)){
								?>
											<?php if(($i-1)%5==4){?>									
											</div>
											<div style="width:2px; height:126px; float:left;"><img src="./imagens/divisormenu.gif" height="126" width="2"></div>
											<div style="width:90px; height:126px; float:left; text-align:left; padding-left:7px; font-size:14px; color:#FFF;display:block">
												<br>
											<?php }?>								
											<a href="?pg=produtos&cat=<?php echo $row["codigo"];?>" style="text-decoration: none; color: rgb(255, 255, 255);"><?php echo $row["nome"];?> &gt;</a><br>
								<?php 		
											$i++;
										}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="div_menu_2" onmouseover="document.getElementById('menu_produto').style.display='none';"><a href="?pg=trabalheconosco" class="div_menu_2">Trabalhe Conosco</a></div>
				<div class="div_menu_2"><a href="?pg=contato" class="div_menu_2">Contatos</a></div>
			</div>
			<div id="icone_home"><a href="index.php" target="_self"><img src="imagens/home.png" width="39px" height="39px" border="0px" onclick="self.location.href='index.htm'"></a></div>
		</div>				
	</div>
</div>
<!-----------------------------------------fim do topo-------------------------------------------->