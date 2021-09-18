<?php
$endereco = "localhost";
$nomeDeUsuario = "root";
$senha = "";
$nomeDoDB = "dogfriends";

try {
    $conexao = new PDO("mysql:host=$endereco; dbname=$nomeDoDB", $nomeDeUsuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão realizada com sucesso";
}
catch(PDOException $e){
    echo "Conexão falhou: " . $e->getMessage();
}

try{
    function insereNovoCachorro($nome,$senha,$raca,$telefone,$dataDeNascimento, $descricao, $foto, $sexo){
        global $conexao;
        
        $stm = $conexao->prepare("INSERT INTO cachorros(nome,senha,raca,telefone,dataDeNascimento,
                descricao,foto,sexo) VALUES (:nome,:senha,:raca,:telefone,:dataDeNascimento,
                :descricao, :foto, :sexo)");
        
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':senha', $senha);
        $stm->bindParam(':raca', $raca);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':dataDeNascimento', $dataDeNascimento);
        $stm->bindParam(':descricao', $descricao);
        $stm->bindParam(':foto', $foto);
        $stm->bindParam(':sexo', $sexo);
        
        $stm->execute();
        
        echo "Cadastro realizado com sucesso!";
        return true;
    }
    
    function confereCadastro($nome,$senha){
        global $conexao;
        
        $rs = $conexao->query("SELECT nome, senha FROM Cachorros WHERE nome='$nome' AND senha='$senha'");
        if($rs->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function retornaDadosDoPerfil($nome,$senha){
        global $conexao;
        $dadosPerfil="sem dados";
        
        $rs = $conexao->query("SELECT * FROM Cachorros WHERE nome='$nome' AND senha='$senha'");
        while($row = $rs->fetch(PDO::FETCH_OBJ)){
            $dadosPerfil = array(
                "nome"=>$row->nome, 
                "raca"=>$row->raca, 
                "telefone"=>$row->telefone, 
                "dataDeNascimento"=>$row->dataDeNascimento, 
                "foto"=>$row->foto, 
                "sexo"=>$row->sexo,
                "descricao"=>$row->descricao
            );
        }
        return $dadosPerfil;
    }
    
    function atualizaPerfil($nomeAntigo,$senhaAntiga,$nome,$senha,$raca,$telefone,$dataDeNascimento, 
        $descricao, $foto, $sexo){
        
        global $conexao;
        
        $stmt = $conexao->prepare("UPDATE cachorros SET 
        nome = :nome, senha = :senha, raca = :raca, telefone =:telefone, dataDeNascimento =:dataDeNascimento,
        descricao =:descricao, foto=:foto, sexo=:sexo 
        WHERE nome=:nomeAntigo and senha=:senhaAntiga");
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':dataDeNascimento', $dataDeNascimento);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':nomeAntigo', $nomeAntigo);
        $stmt->bindParam(':senhaAntiga', $senhaAntiga);
        
        $stmt->execute();
        
        echo "Atualização realizada com sucesso!";
        return true;
    }
    
    function exibeTodosOsCaes($nome,$senha){
        global $conexao;      
        $rs = $conexao->query("SELECT * FROM Cachorros WHERE nome!='$nome' OR senha!='$senha'");
        while($row = $rs->fetch(PDO::FETCH_OBJ)){  
           echo "<form action='../Controller/salvaAmigos.php' method='post'>";
           list ($ano, $mes, $dia) = explode('-', $row->dataDeNascimento);
           echo "<h4>$row->nome - $row->raca - $row->sexo <br> Data de Nascimento: $dia / $mes / $ano </h4>";
           echo "<img src='imagens/$row->foto' width='20%'/> $row->descricao <br><br>";
           echo "<input type=hidden name=nome2 value='$row->nome'>";
           echo "<input type=hidden name=senha2 value='$row->senha'>";
           echo "<input type='submit' class='btn btn-danger' value='Enviar pedido de amizade'></br><br>";
           echo "</form>";
        }
    }
    
    function salvaAmizade($nome,$senha,$nome2,$senha2){
        global $conexao;
        
        $stm = $conexao->prepare("INSERT INTO amizades(nome,senha,nome2,senha2) 
                VALUES (:nome,:senha,:nome2,:senha2)");
        
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':senha', $senha);
        $stm->bindParam(':nome2', $nome2);
        $stm->bindParam(':senha2', $senha2);
        
        $stm->execute();
        
        echo "Solicita��o de amizade enviada com sucesso";
        return true;
    }
    
    function exibeAmigos($nome,$senha){
        global $conexao;      
        $rs = $conexao->query("SELECT * FROM Cachorros WHERE nome in (SELECT nome FROM amizades WHERE nome2 = '$nome')");
        while($row = $rs->fetch(PDO::FETCH_OBJ)){
           $rs2 = $conexao->query("SELECT * FROM amizades WHERE nome = '$nome' AND nome2= '$row->nome'");
            if($rs2->rowCount()>0){
                list ($ano, $mes, $dia) = explode('-', $row->dataDeNascimento);
                echo "<h4>$row->nome - $row->raca - $row->sexo <br> Data de Nascimento: $dia / $mes / $ano </h4>";
                echo "<img src='imagens/$row->foto' width='20%'/> $row->descricao <br><br>";
                echo "Entre em contato comigo: $row->telefone <br><br>";
            }
        }
    }
    
    
    
}
catch(PDOException $e){
    echo "Conexão falhou: " . $e->getMessage();
}
?>




