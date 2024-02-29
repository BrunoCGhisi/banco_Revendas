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
    $nome = $_POST['nome'];

    //criar comando GRAVAR (INSERT) no banco dados
    $sql ="INSERT INTO marca (codigo,nome)
    VALUES ('$codigo', '$nome')";

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
    $nome = $_POST['nome'];

    //criar comando EXCLUIR (DELETE) no banco dados
    $sql ="DELETE FROM marca (codigo,nome)
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
    $nome = $_POST['nome'];

    //criar comando EXCLUIR (DELETE) no banco dados
    $sql ="UPDATE marca SET nome='$nome'
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
    $sql = mysqli_query($conectar, "SELECT codigo, nome FROM marca");

    echo "<b>Marcas Cadastradas:</b><br><br>";
    while ($dados = mysqli_fetch_object($sql))
    {
        echo "Codigo: ". $dados->codigo. " ";
        echo "Nome: ". $dados->nome."<br>";
    }


}


