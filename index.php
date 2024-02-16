<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculadora PHP</title>
  </head>
  <body>
    
    <?php 
      if(isset($_GET["usuarioRes"])) {
        echo "Usuario: ".$_GET["usuarioRes"]."<br><br>";
      }
      if(isset($_GET["resultado"])){
        echo "Resultado: ".$_GET["resultado"]."<br><br>";
      }
    ?>

    <form action="calcular.php" method="post">
      <label for="usuarioRes">
        Usuario:
        <input type="text" name="usuarioRes">
      </label>
      <br><br>
      <label for="operando_1">
        Operando 1:
        <input type="text" name="operando_1">
      </label>
      <br><br>
      <label for="operando_2">
        Operando 2:
        <input type="text" name="operando_2">
      </label>
      <br><br>
      <label for="operando_3">
        Operando 3:
        <input type="text" name="operando_3">
      </label>
      <br><br>
      <input type="submit" value="Calcular">
    </form>
    
  </body>
</html>