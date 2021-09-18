<html>
<?php
	require("../Model/acessaBD.php");
	if(insereNovoCachorro(
	    $_POST['nome'], 
	    $_POST['senha'], 
	    $_POST['raca'], 
	    $_POST['telefone'], 
	    $_POST['data'],
	    $_POST['descricao'],
	    $_POST['foto'],
	    $_POST['sexo'])){
	    
        session_start();
        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['senha'] = $_POST['senha'];
	       
        echo  "<form action='../View/perfil.php' method='post'>";
        echo "<input type='submit' class='btn btn-light' value='Entrar'>";
        echo "</form>";
	}
	else{
	    echo "Erro no cadastro";
	    echo  "<form action='../View/index.html' method='post'>";
	    echo "<input type='submit' class='btn btn-light' value='Tentar novamente'>";
	    echo "</form>";
	}	
?>
</html>


