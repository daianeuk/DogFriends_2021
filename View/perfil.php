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
					<li><img src="imagens/logoMenu.png" width="100% "  /></li>
					<li><a href= "perfil.php"><img src="imagens/iconeHome.png" width="20%" title="Perfil"/></a></li>
					<li><a href= "amigos.php"><img src="imagens/iconeAmigos.png" width="20%" title="Amigos"/></a></li>
					<li><a href= "caes.php"><img src="imagens/iconeCaes.png" width="20%" title="Cães"/></a></li>
					<li><a href= "index.html"><img src="imagens/sair.png" width="20%" title="Sair"/></a></li>				
				</ul>
		</div>		
		</br></br>
		<?php 
		  require("../Model/acessaBD.php");
		  session_start();
		  $dados = retornaDadosDoPerfil($_SESSION['nome'],$_SESSION['senha']);
		?>
		<div id="perfil">
			<table>
					<tr>
						<td colspan=2><h2><p align="center"><?php echo $dados['nome']?></p></h2></td>
					</tr>
					<tr>
						<td width=40%> <img src="<?php echo "../View/imagens/".$dados['foto']?>" width=100%/></td>
						<td> <?php echo "Raça: ". $dados['raca']?> <br> 
						<?php echo "Sexo: ".$dados['sexo']?> <br> 
						<?php 
						  list ($ano, $mes, $dia) = explode('-', $dados['dataDeNascimento']);
						  echo "Data de Nascimento: $dia / $mes / $ano";
						?> <br> 
						<?php echo "Telefone: ".$dados['telefone']?> </td>
					</tr>
					<tr style="border:1pt solid black;">
						<td colspan=2><p align="center"><?php echo $dados['descricao']?></td>
					</tr>
					<tr>
						<td colspan=2>
							<br><br>
							<p align=right><a href="atualizarPerfil.html" class="btn btn-danger active" role="button">
							Atualizar Perfil</a></p>
						</td>
					</tr>
			</table>	
		</div>
		
	</body>
	
</html>