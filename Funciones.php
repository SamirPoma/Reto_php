<?php

function GanoJugador($arreglo){
    $contador = 0;
      for ($i =0; $i < count($arreglo); $i++){
        if( $arreglo[$i][1] == true){
            $contador++;
        }
    }
    
    return $contador == count($arreglo);
}

function BuscarNumero($arreglo , $numero){
    
    for ($i =0; $i < count($arreglo); $i++){
        if($arreglo[$i][0] == $numero && $arreglo[$i][1] == false){
            return $i;
        }
    }
    return -1;
}

function GenerarBingo() {
    $arreglo = array();
    $inicio = 1;
    $fin = 15;
    $contador = 0;
    // 0 , 5 , 10 , 15 ,20
    // 1 , 6, 11 , 16 ,21
    // 2 , 7, 12 , 17 ,22
    // 3 , 8, 13 , 18 ,23
    // 4 , 9, 14 , 19 ,24
    for ($i = 0; $i < 24; $i++):
        $num = rand($inicio, $fin);
        $encontro = false;
        for ($j = 0; $j < count($arreglo); $j++):
            if ($num == $arreglo[$j]):
                $encontro = true;
                break;
            endif;
        endfor;
        if ($encontro == false):
            $arreglo[] = array($num , false);
            $contador++;

        else:
            $i = $i - 1;
        endif;


        if ($contador >= 5):
            $inicio += 15;
            $fin += 15;
            $contador = 0;
        endif;
    endfor;
    return $arreglo;
}


?>