<?php 
//conectar ao banco de dados

$conectar = mysqli_connect("localhost", "root", "");
$banco    = mysqli_select_db($conectar,'revenda');
if (!$conectar) {
    die("Conexão falhou: " . mysqli_connect_error());
}
$banco = mysqli_select_db($conectar, 'revenda');
if (!$banco) {
    die("Seleção do Banco de Dados falhou: " . mysqli_error($conectar));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Acessar Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body> 
    <header class="cabecalho"> 
        <h1 class="titulo_referente">  Acessando Login </h1>
        <nav class="cabecalho__sub"> 
            <a class="cabecalho__sub__link" href="../cadastroUsuarios.html">    Usuarios </a>
        </nav>
        <nav class="cabecalho__sub__sub">
            <a class="cabecalho__sub__link" href="index.php">                Home     </a>
        </nav>
    </header>
<main class="container">
    <div class="forms">
        <form class ="forms__formularios__php"name='formulario' method="post" action="logan.php">
            <label class="formulario__text"> Login: </label>
            <input type="text" name="nome" id="nome"  size=20  required>
            
            <label class="formulario__text" >Senha: </label>
            <input type="password" name="senha" id="senha"  size=20  required>
            <section class="formulario__separacao">
                <input class="formulario__separacao__button" type="submit" value="Conectar" id="conectar" name="conectar">
            </section>
        </form>
        
<?php 

if (isset($_POST['conectar']))
{
$nome   = $_POST ['nome'];
$senha   = $_POST['senha'];

$sql = mysqli_query($conectar, "select nome, senha FROM usuarios  where nome = '$nome' and senha = '$senha'");


$resultado = mysqli_num_rows($sql);

if ($resultado == 0)
{
   echo "Login ou senha inv�lido...";
}
else
{
   //Cria a sess�o e manda para pagina menu de cadastros
   session_start();
   $_SESSION['nome'] = $nome;
   header("Location:home.php");
}
}

?>
    </div>
</main>