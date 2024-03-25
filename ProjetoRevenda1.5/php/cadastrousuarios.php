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
    $nome      = $_POST['nome'];
    $email     = $_POST['email'];
    $senha     = $_POST['senha'];

    //criar comando GRAVAR (INSERT) no banco dados
    $sql ="INSERT INTO usuarios (nome, email, senha)
    VALUES ('$nome', '$email', '$senha')";

    //executar o comando SQL no BD
    $resultado = mysqli_query($conectar, $sql);

    //verificar se graviy cin sucesso no BD 
    if ($resultado === true) 
    {
        echo "Cadastro de usuario realizado com Sucesso" . PHP_EOL;
    } else {
        echo "Cadastro não foi efetuado com sucesso...". PHP_EOL;
    }
} 

if (isset($_POST['excluir']))
{
    //capturar as variaves do html
    $codigo = $_POST['codigo'];
    
    //criar comando EXCLUIR (DELETE) no banco dados
    $sql ="DELETE FROM usuarios
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
    $nome   = $_POST['nome'];
    $email  = $_POST['email'];
    $senha  = $_POST['senha'];

    //criar comando ALTERAR (UPDATE) no banco dados
    $sql ="UPDATE usuarios SET senha='$senha', email='$email'
    WHERE nome = '$nome' and senha = '$senha'";

    //executar o comando SQL no BD
    $resultado = mysqli_query($conectar, $sql);

    //verificar se graviy cin sucesso no BD 
    if ($resultado == true) 
    { echo "Usuario atualizado com Sucesso" . PHP_EOL; }     
    else { echo "Atualização do usuario não foi efetuada com sucesso...". PHP_EOL; }
}

if (isset($_POST['pesquisar']))
{$sql = mysqli_query($conectar, "SELECT codigo, nome, email, senha FROM usuarios");
    echo "<b>Usuarios Cadastrados:</b><br><br>";
    while ($dados = mysqli_fetch_object($sql))
    {
        echo "Codigo: ". $dados->codigo. "<br>";
        echo "Email:  ". $dados->nome.   "<br>";
        echo "Nome:   ". $dados->email.  "<br>";
        echo "Senha:  ". $dados->senha.  "<br>";
    }

}