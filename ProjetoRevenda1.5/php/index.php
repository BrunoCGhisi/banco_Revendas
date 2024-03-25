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
    <title>Cadastro Veiculos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body> 
    <header class="cabecalho"> 
        <h1 class="titulo_referente">  Bem-Vindo(a) Carros Ghisi </h1>
        <nav class="cabecalho__sub"> 
            <a class="cabecalho__sub__link" href="../cadastroUsuarios.html">    Criar login     </a>
            <a class="cabecalho__sub__link" href="logan.php">                   Acessar Banco   </a>
        </nav>
    </header>
<main class="container">
    <div class="forms"> 
    <section class="formulario__separacao" style="flex-direction: column; justify-content: center;">
        <form class ="forms__formularios__php"name='formulario' method="post" action="index.php">

            <label class="formulario__text" for=""> Marcas:     </label>
            <select name="marca">
            <option class="formulario__text" value="" selected="selected">   Selecione...</option>

            <?php
        $query = mysqli_query($conectar, "SELECT codigo, nome FROM marca");
        while($marcas = mysqli_fetch_array($query))
        {?>
        <option value="<?php echo $marcas['codigo']?>">
                       <?php echo $marcas['nome']   ?></option>
        <?php }
        ?>
        </select>
        
        <label class="formulario__text" for="">  Modelos:     </label>
        <select name="modelo">
        <option  value="" selected="selected">   Selecione... </option>

        </section>
        <?php
        $query = mysqli_query($conectar, "SELECT codigo, nome FROM modelo");
        
        while($modelos = mysqli_fetch_array($query))
        {?>
        <option value="<?php echo $modelos['codigo']?>">
                       <?php echo $modelos['nome']   ?>
        </option>
        <?php }
        ?>

        </select>
        <section class="formulario__separacao">
            <input class= "formulario__separacao__button" type="submit" name="pesquisar" value="Pesquisar">
        </section>
    </form>
        <br><br>

<?php
if (isset($_POST['pesquisar']))
{
$marca       = (empty($_POST['marca']))?  'null' : $_POST['marca'];
$modelo      = (empty($_POST['modelo']))? 'null' : $_POST['modelo'];

// ----------------------- Pesquisando ai po --------------------- // 
if ($marca !== 'null') {
    $sql_veiculos = "SELECT descricao, ano, cor, valor
                     FROM veiculo
                     INNER JOIN modelo ON veiculo.codmodelo = modelo.codigo
                     INNER JOIN marca ON modelo.codmarca = marca.codigo
                     WHERE marca.codigo = ?";
    $stmt = mysqli_prepare($conectar, $sql_veiculos);
    mysqli_stmt_bind_param($stmt, "i", $marca); // "i" indica que o parâmetro é um inteiro
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);



?>
<section class="formulario__separacao"> <?php

    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            // Processar cada linha do resultado
                
            echo "<p class='formulario__text'>" . "Descrição: " . $marca . $linha['descricao'] . "</p>";
            echo "<p class='formulario__text'>" . "Ano: "       . $linha['ano'] . "</p>";
            echo "<p class='formulario__text'>" . "Cor: "       . $linha['cor'] . "</p>";
            echo "<p class='formulario__text'>" . "Valor: "     . $linha['valor'] . "</p>";
            // E assim por diante para os outros campos
        }
    } else {
        echo "<p class='formulario__text'> Não foi possível encontrar o esperado...";
    }
    mysqli_stmt_close($stmt);
}  
}
?>
</section>
</main>

<footer class="rodape" style="margin-top:300px;">
    @ Desenvolvido por Bruno Costa Ghisi 2024
</footer>
