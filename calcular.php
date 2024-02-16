<?php

include "classes/calculadora.php";

$usuario = $_POST['usuarioRes'];
$operando_1 = $_POST['operando_1'];
$operando_2 = $_POST['operando_2'];
$operando_3 = $_POST['operando_3'];

$calculadora = Calculadora::getInstance();

$calculadora -> setUsuario($usuario);
$calculadora -> setOperando1($operando_1);
$calculadora -> setOperando2($operando_2);
$calculadora -> setOperando3($operando_3);

$calculadora -> verificar();

$query = array(
    'resultado' => $calculadora -> getResultado(), 
    'usuarioRes' => $calculadora -> getUsuario()
    );

$query = http_build_query($query);
header("Location:index.php?$query");