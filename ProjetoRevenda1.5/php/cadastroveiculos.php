<?php
//iniciar sessão
session_start();

//conectar com banco de dados

$conectar = mysqli_connect("localhost","root","");

//escolher qual banco de dados usar

$banco = mysqli_select_db($conectar, "revenda");

//verificar qual opção foi escolhida (gravar, excluir, alterar, pesquisar)

if (isset($_POST['gravar']))
{
    
    //capturar as variaves do html
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $codmodelo = $_POST['codmodelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];
    $opcionais = $_POST['opcionais'];
    $valor = $_POST['valor'];

    // incluir arquivos fotos (endere�o da pasta no computador)
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

    //criar pasta computador
    $diretorio = "../fotos/";

    //Esta fun��o  usada para converter caracteres em string
    $extensao1 = strtolower(substr($_FILES['foto1'] ['name'], -4));
    //faz md5 para nao ter nomes repetidos nas fotos
    $novo_nome1 = md5(time()).$extensao1;
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);

    // faz a mesma coisa pra foto2
    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time()).$extensao2;
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);


    $sql = "INSERT INTO veiculo (codigo,descricao,codmodelo,ano,cor,placa,
          opcionais,valor,foto1,foto2)
          VALUES ('$codigo','$descricao','$codmodelo','$ano','$cor','$placa',
          '$opcionais','$valor','$novo_nome1','$novo_nome2')";

    //executar o comando SQL no BD
    $resultado = mysqli_query($conectar, $sql);

    //verificar se graviy cin sucesso no BD 
    if ($resultado === true) 
    {
        echo "Cadastro realizado com Sucesso" . PHP_EOL;
    } else {
        echo "Cadastro não foi efetuado com sucesso...". PHP_EOL;
    }



} 

if (isset($_POST['excluir']))
{
    //capturar as variaves do html
    $codigo = $_POST['codigo'];
    
    //criar comando EXCLUIR (DELETE) no banco dados
    $sql ="DELETE FROM veiculos 
    WHERE codigo = '$codigo'";

    //executar o comando SQL no BD
    $resultado = mysqli_query($conectar, $sql);

    //verificar se graviy cin sucesso no BD 
    if ($resultado == true) 
    {
        echo "Excluido com Sucesso" . PHP_EOL;
    } else {
        echo "Excluido não foi efetuado com sucesso...". PHP_EOL;
    }

} 

if (isset($_POST['alterar']))
{
    //capturar as variaves do html
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $codmodelo = $_POST['codmodelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];
    $opcionais = $_POST['opcionais'];
    $valor = $_POST['valor'];

    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

    

    //criar pasta computador
    $diretorio = "../fotos/";

    //Esta fun��o  usada para converter caracteres em string
    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    //faz md5 para nao ter nomes repetidos nas fotos
    $novo_nome1 = md5(time()).$extensao1;
    //mover arquivo da foto1 para a pasta FOTOS no computador
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);
 
    // faz a mesma coisa pra foto2
    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time()).$extensao2;
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);
    
    $sql = "UPDATE veiculo SET opcionais='$opcionais',valor='$valor',
            foto1='$novo_nome1', foto2='$novo_nome2'
            WHERE codigo = '$codigo'";

    //executar o comando SQL no BD
    $resultado = mysqli_query($conectar, $sql);

    //verificar se graviy cin sucesso no BD 
    if ($resultado == true) 
    {
        echo "Atualizado com Sucesso" . PHP_EOL;
    } else {
        echo "Atualização não foi efetuada com sucesso...". PHP_EOL;
    }

}

if (isset($_POST['pesquisar']))
{
    $sql = mysqli_query($conectar, "SELECT codigo,descricao,codmodelo,
    ano,cor,placa,opcionais,valor,foto1,foto2 FROM veiculo");

    echo "<b>Veiculos Cadastrados:</b><br><br>";
    while ($dados = mysqli_fetch_object($sql))
    {
        echo "Codigo: ".    $dados->codigo. " ";
        echo "Descricao: ". $dados->descricao."<br>";
        echo "Codmodelo: ". $dados->codmodelo."<br>";
        echo "Ano :       ".$dados->ano." ";
        echo "Cor :       ".$dados->cor." ";
        echo "Placa :     ".$dados->placa." ";
        echo "Opcionais : ".$dados->opcionais."<br> ";
        echo "Valor R$  : ".$dados->valor."<br>";
        echo '<img src="../fotos/'.$dados->foto1.'" height="100" width="150" />'." ";
        echo '<img src="../fotos/'.$dados->foto2.'" height="100" width="150" />'."<br><br>";
    }


}