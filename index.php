
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

        <title></title>
    </head>
    <style>
        .bingo{
            color:darkblue;
            font-weight: bold;
        }
        .pintado{
            background: red;
            color: white;
            font-weight: bold;
        }

    </style>
    <body>
        <?php
        include './Funciones.php';
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

        $gano = GanoJugador($arreglo);
        ?>

        <div class="container mt-3">
            <form action="ControlBingo.php">
              
                <?php
                if ($gano) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        Felicitaciones!! BINGO
                    </div>
                  <input type="hidden" name="accion" value="reiniciar">
                    <button type="submit" class="btn btn-primary" >Reiniciar Juego</button>
                    <?php
                } else {
                    ?>
                      <input type="hidden" name="accion" value="generar">
                    <button type="submit" class="btn btn-primary" >Generar numero</button>
                    <?php
                }
                ?>

            </form>
            <table class="table table-bordered">

                <?php
                $bin = 0;
                $letra = array("B", "I", "N", "G", "O");
                for ($i = 0, $num = 1; $i <= count($arreglo); $i++, $num++):

                    if ($i % 5 == 0):
                        echo "<tr><td class='bingo'>" . $letra[$bin];
                        $bin++;
                    endif;


                    if ($num <= 12):
                        $numero = $arreglo[$i][0];

                        if ($arreglo[$i][1]) {
                            echo "<td class='pintado'>$numero</td>";
                        } else {
                            echo "<td>$numero</td>";
                        }

                    else :
                        if ($num == 13):
                            echo "<td>X</td>";
                        else:
                            $indice = $i - 1;
                            $numero = $arreglo[$indice][0];
                            if ($arreglo[$indice][1]) {
                                echo "<td class='pintado'>$numero</td>";
                            } else {
                                echo "<td>$numero</td>";
                            }
                        endif;
                    endif;

                endfor;
                ?>


            </table> 
            <br>

            <?php
            if (count($generados) > 0) {
                ?>
                <h1>Numeros Seleccionados:</h1>

                <?php
                for ($i = count($generados) - 1; $i >= 0; $i--) {
                    ?>

                    <ul class="list-group">
                        <li class="list-group-item">Numero: <?= $generados[$i] ?></li>

                    </ul>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
