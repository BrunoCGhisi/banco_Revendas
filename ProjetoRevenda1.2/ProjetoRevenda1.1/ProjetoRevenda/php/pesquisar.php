<?php
//conectar com bando dados
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('revenda');
?>

<HTML>
<HEAD>
 <TITLE> Pesquisa Veiculos</TITLE>
</HEAD>
<body>
    <form name="formulario" method="post" action="pesquisar.php">
       <img src="logo.jpg" width=200 height=150 align="center">
       <h1>REVENDA DE CARROS</h1><br>
       
       <h1>Pesquisa de Veículos por:</h1>
       <label for="">Marcas: </label>
        <select name="marca">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT codigo, nome FROM marca");
        while($marcas = mysql_fetch_array($query))
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
        $query = mysql_query("SELECT codigo, nome FROM modelo");
        
        while($modelos = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $modelos['codigo']?>">
                       <?php echo $modelos['nome']   ?></option>
        <?php }
        ?>

        </select>
        <input  type="submit" name="pesquisar" value="Pesquisar">
    </form>
        <br><br>

<?php

if (isset($_POST['pesquisar']))
{

//------- pesquisa marcas   if   ???


//------- pesquisa modelos  if  ????


// mostrar as informações dos veiculos ????


}
?>
</body>

</HTML>
