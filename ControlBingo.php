<?php

include './Funciones.php';

$accion = $_REQUEST["accion"];

session_start();

if (!isset($_SESSION["bingo"])) {
    $arreglo = GenerarBingo();
    $_SESSION["bingo"] = $arreglo;
} else {
    $arreglo = $_SESSION["bingo"];
}

if (!isset($_SESSION["generados"])) {
    $generados = array();
} else {
    $generados = $_SESSION["generados"];
}

if ($accion == "generar") {

    $numero = rand(1, 75);

    $indice = BuscarNumero($arreglo, $numero);

    if ($indice != -1) {
        $arreglo[$indice][1] = true;
        $_SESSION["bingo"] = $arreglo;
    }

    $generados[] = $numero;
    $_SESSION["generados"] = $generados;
}else if($accion == "reiniciar"){
    session_destroy();
}
header("location: ./index.php");
?>
