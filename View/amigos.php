<!doctype html>
<html lang="pt-br">
	<head>
		<title>DogFriends</title>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="imagens/iconeAba.png">
		
		<link rel="stylesheet" type="text/css" href="estilo.css">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
		integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	
	</head>
	<body>
		<div id="menu">
				<ul>
					<li><img src="imagens/logoMenu.png" width="100% "/></li>
					<li><a href= "perfil.php"><img src="imagens/iconeHome.png" width="20%" title="Perfil"/></a></li>
					<li><a href= "amigos.php"><img src="imagens/iconeAmigos.png" width="20%" title="Amigos"/></a></li>
					<li><a href= "caes.php"><img src="imagens/iconeCaes.png" width="20%" title="Cães"/></a></li>
					<li><a href= "index.html"><img src="imagens/sair.png" width="20%" title="Sair"/></a></li>				
				</ul>
		</div>		
		<br>
		<div id="conteudo">
				<?php 
				  	require("../Model/acessaBD.php");
		 		  	session_start();
		  		  	exibeAmigos($_SESSION['nome'],$_SESSION['senha']);
				?>		
		</div>
	</body>
</html>


