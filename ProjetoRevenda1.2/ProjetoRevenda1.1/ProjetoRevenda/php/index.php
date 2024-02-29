<?php 
//conectar ao banco de dados
$conectar = mysqli_connect("localhost","root","");
$banco    = mysqli_select_db($conectar,'revenda');
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
            <a class="cabecalho__sub__link" href="../cadastroMarcas.html">      Marcas  </a>
            <a class="cabecalho__sub__link" href="../cadastroModelos.html">     Modelos </a>
            <a class="cabecalho__sub__link" href="../cadastr.html">                               Veiculos</a>
            
        </nav>
    </header>
<main class="container">
    <div class="forms"> 
        aaaaaaaasdjnfdak
        <form name='formulario' method="post" action="index.php">
            <label for=""> Marcas: </label>
            <select name="marca">
            <option value="" selected="selected">Selecione...</option>

            <?php
        $query = mysqli_query($conectar, "SELECT codigo, nome FROM marca");
        while($marcas = mysqli_fetch_array($query))
        {?>
        <option value="<?php echo $marcas['codigo']?>">
                       <?php echo $marcas['nome']   ?></option>
        <?php }
        ?>
        </select>

        <label for="">Modelos: </label>
        <select name="modelo">
        <option value="" selected="selected">Selecione...</option>

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
        <input  type="submit" name="pesquisar" value="Pesquisar">
    </form>
        <br><br>

<?php
if (isset($_POST['pesquisar']))
{
    $sql = mysqli_query($conectar, "SELECT codigo, nome FROM marca");

    echo "<b>Marcas Cadastradas:</b><br><br>";
    while ($dados = mysqli_fetch_object($sql))
    {
        echo "Codigo: ". $dados->codigo. " ";
        echo "Nome: ". $dados->nome."<br>";
    }

    $sql = mysqli_query($conectar, "SELECT codigo, nome FROM marca");

    echo "<b>Marcas Cadastradas:</b><br><br>";
    while ($dados = mysqli_fetch_object($sql))
    {
        echo "Codigo: ". $dados->codigo. " ";
        echo "Nome: ". $dados->nome."<br>";
        echo "Codmarca: ". $dados->codmarca."<br>";
    }

}


    
    
?>

</main>
</body>
