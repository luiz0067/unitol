<?php
	$host		=	"your server";
	$login		=	"user name";
	$password	=	"password";
	$base_dados	=	"data base name";

if (!$link = mysql_connect($host, $login, $password)) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db($base_dados, $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}


?>