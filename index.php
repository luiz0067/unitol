<?php include('./adm/conecta.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Unitol uniformes profissionais LTDA</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="./adm/lightbox/js/prototype.js"></script>
		<script type="text/javascript" src="./adm/lightbox/js/scriptaculous.js?load=effects,builder"></script>
		<script type="text/javascript" src="./adm/lightbox/js/lightbox.js"></script>
		<script type="text/javascript" src="./js/swfobject_modified.js"></script>
		<script type="text/javascript" src="./js/index.js"></script>		
		<style type="text/css">
			@import url("./css/estilo.css");
			@import url("./adm/lightbox/css/lightbox.css");
        </style>
	</head>
<body>
		<div class="tudo" style="height:auto;min-height:auto;" id="conteudo_site">
			<?php include("topo.php");?>
<!-----------------------------------------conteudo-------------------------------------------->
			<?php 
			if (isset($_GET["pg"]))
				$pg=$_GET ['pg'];
			else
				$pg="";
				if($pg=="quemsomos")
					include("quemsomos.php");
				else if($pg=="faleconosco")
					include("faleconosco.php");
				else if($pg=="atendimento")
					include("atendimento.php");
				else if($pg=="institucional")
					include("institucional.php");
				else if($pg=="servicos")
					include("servicos.php");
				else if($pg=="produtos")
					include("produtos.php");
				else if($pg=="trabalheconosco")
					include("trabalheconosco.php");
				else if($pg=="contato")
					include("contato.php");
				else
					include("home.php");
			?>		
<!-------------------------------- fim da div de conteudo ---------------------------------------------->         		
			<?php include("orcamento.php");?>
			<?php include("rodape.php");?>			
		</div>
    </body>
</html>
