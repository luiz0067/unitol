<div class="row" style="auto;">
	<div class="mapadepercurso">
	  <div class="branco" style="width:18px; height:auto;min-height:50px; float:left;"></div>
		<div class="branco" style="width:882px; height:auto;min-height:50px; float:left;">
		  <a style="color:#F00; font-size:10px; font-family:century;">MAPA DE PERCURSO</a><br>
		  <a style="color:#000; font-size:10px; font-family:century;">Você está em: Home >  Contato</a><br>
		</div>
	</div>
	<div class="center" style="height:auto;min-height:44px;">
		<div class="branco" style="width:18px; height:auto;min-height:44px; float:left"></div>
		<div class="h1" style="width:200px; height:auto;min-height:44px; float:left; font-family:century; font-size:29px; text-align:left;">Contato</div>
		<div class="branco" style="width:682px; height:auto;min-height:44px; float:left;"></div>
	</div>
	<div  class="center" style="height:auto;min-height:415px;">
		<div class="center" style="height:auto;min-height:415px">
			<div class="branco" style="width:18px; float:left;height:auto;min-height:415px;"></div>
			<div id="formulario" style="text-align:left; height:auto;min-height:415px; font-size:14px; font-family:century;">
				<form  method="post" style="width:500px; height:auto;min-height:400px; margin-left:20px;">	
				<?php
						
					if (isset($_POST["nome"]))
						$nome=$_POST ['nome'];
					else
						$nome="";	
						
					if (isset($_POST["acao"]))
						$acao=$_POST ['acao'];
					else
						$acao="";

					if (isset($_POST["email"]))
						$email=$_POST ['email'];
					else
						$email="";
					$enviar=true;
				?>
					Nome<br>
					<input name="nome" type="text" size="70" align="left"/>
					<div style="color:red"><?php if (($nome="")&&($acao=="Enviar")) {echo "Preencha o nome"; $enviar=false;}?></div>
					<br><br>
					E-mail<br>
					<input name="email" type="text" size="70" align="left"/>
					<div style="color:red"><?php 
						if (($email=="")&&($acao=="Enviar")) 
						{
							$tamanho =strlen($email);
							if (
								($tamanho<7)
								||
								(strrpos($email, '.')==false)
								||
								(strrpos($email, '@')==false)
							){
								echo "Preencha o email"; 
								$enviar=false;
							}
						}
					?></div><br><br>
					
					<?php
		
						if (isset($_POST["telefone"]))
							$telefone=$_POST ['telefone'];
						else
							$telefone="";
							
						if (isset($_POST["cidade"]))
							$cidade=$_POST ['didade'];
						else
							$cidade="";	
							
						if (isset($_POST["mensagem"]))
							$mensagem=$_POST ['mensagem'];
						else
							$mensagem="";

						?>
					Telefone<br>
					<div style="color:red"><?php if (($telefone=="")&&($acao=="Enviar")) {echo "Preencha o Telefone"; $enviar=false;}?></div>
					<input name="telefone" type="text" size="70" align="left"/><br><br>
					Cidade<br>
					<input name="cidade" type="text" size="70" align="left"/>
					<div style="color:red"><?php if (($cidade=="")&&($acao=="Enviar")) {echo "Preencha o Cidade"; $enviar=false;}?></div>
					<br>
					Mensagem<br>
					<textarea name="mensagem" style="width:440px;" cols="70" rows="4" align="left"></textarea>
					<div style="color:red"><?php if (($mensagem=="")&&($acao=="Enviar")) {echo "Preencha o Mensagem"; $enviar=false;}?></div>
				  <br><br>
					<input name="acao" type="submit" value="Enviar" />
					<input name="Enviar" type="reset" value="Limpar" />
				</form>
				<?php if(($enviar)&&($acao=="Enviar")){
					$corpo = "Formulário enviado\n"; 
					$corpo .= "Nome: " . $nome . "\n"; 
					$corpo .= "Email: " . $email . "\n"; 
					$corpo .= "Telefone: " . $telefone . "\n"; 
					$corpo .= "Cidade: " . $cidade . "\n"; 
					$corpo .= "Comentários: " . $mensagem . "\n"; 

					//envio o correio... 
					mail("contato@unitol.com.br","Formulário recebido",$corpo); 
					mail("luiz0067@yahoo.com.br","Formulário recebido",$corpo); 

					//agradeço pelo envio 
					echo "Obrigado por preencher o formulário. Foi enviado corretamente."; 
				}?>
		  </div>
		  <div class="branco" style="width:10px; height:auto;min-height:415px; float:left;"></div>
		  <div class="branco" style="width:205px; height:auto;min-height:415px; float:left; text-align:left; font-family:'century'; font-size:14px; color:#000;"><a style="color:#F00;
		   font-size:18px; font-family:century;">
		  UNITOL</a><br>Uniformes Profissionais Ltda.<br><br>Rua Carlos Drumond de Andrade<br>Jd. Bela Vista<br>Toledo | PR<br>CEP 85.908-050<br><br>
		  <a style="color:#F00; font-size:18px; font-family:century;">ATENDIMENTO</a><br>45 | 3278-1720
		  </div>
	   </div>
	</div>
	<div class="center" style="height:auto;min-height:94px;"></div>
</div>
