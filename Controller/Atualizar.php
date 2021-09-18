<html>
<?php
	require("../Model/acessaBD.php");
	session_start();
	$nomeAntigo=$_SESSION['nome'];
	$senhaAntiga = $_SESSION['senha'];
	if(atualizaPerfil(
	    $nomeAntigo, $senhaAntiga,
	    $_POST['nome'], $_POST['senha'],
	    $_POST['raca'], $_POST['telefone'],
	    $_POST['data'], $_POST['descricao'],
	    $_POST['foto'], $_POST['sexo'])
	    ){        
        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['senha'] = $_POST['senha'];     
        echo "<form action='../View/perfil.php' method='post'>";
        echo "<input type='submit' class='btn btn-light' value='Voltar para o site'>";
        echo "</form>";
	}
	else{
	    echo "Erro na atualização";
	    echo  "<form action='../View/index.html' method='post'>";
	    echo "<input type='submit' class='btn btn-light' value='Tentar novamente'>";
	    echo "</form>";
	}	
?>
</html>


