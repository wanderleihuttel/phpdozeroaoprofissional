<?php
$data = $_POST['ano'].'-'.$_POST['mes'];
$dia1 = date('w', strtotime($data));
$dias = date('t', strtotime($data));
$linhas = ceil(($dia1+$dias)/7);
$dia1 = -$dia1;
$data_inicial = date('Y-m-d', strtotime($dia1 . ' days', strtotime($data)));
$data_final = date('Y-m-d', strtotime(($dia1+($linhas*7) - 1) . ' days', strtotime($data)));
$ultimo_dia = date("Y-m-t", strtotime($data));
$datediff = date_diff( date_create($ultimo_dia), date_create($data_final) );

/*
echo "PRIMEIRO DIA: $dia1<br/>";
echo "TOTAL DIAS: $dias<br/>";
echo "LINHAS: $linhas<br/>";
echo "DATA INICIO: $data_inicial<br/>";
echo "DATA FINAL:  $data_final<br/>";
echo "ÚLTIMO DIA:  $ultimo_dia<br/>";
echo "DIFERENÇA:   $datediff->days<br/>";
*/

?>
    <div class="col-sm-12">
    <table class="table table-sm table-bordered thead-light">
    <thead class="thead-dark">
        <th colspan="7"><?php echo date('F/Y', strtotime($data)); ?></th>
    </thead>
    <thead class="thead-light">
        <th class="text-center">Domingo</th>
        <th class="text-center">Segunda-feira</th>
        <th class="text-center">Terça-feira</th>
        <th class="text-center">Quarta-feira</th>
        <th class="text-center">Quinta-feira</th>
        <th class="text-center">Sexta-feira</th>
        <th class="text-center">Sábado</th>
    </thead>
    <tbody>
    <?php

        for ($i=0; $i < $linhas; $i++) {
            echo "<tr>";
            for ($j=0; $j < 7; $j++){
                $d = date('Y-m-d', strtotime(( $j+($i*7)) . ' days', strtotime($data_inicial)) );

                    if( $i == 0 && $j + $dia1 < 0 ) {
                        echo "<td class='text-center'></td>";
                    } else if ($i == $linhas-1 && $j >= 7- $datediff->days ){
                        echo "<td class='text-center  alert alert-light'></td>";
                    }
                    else {
                        echo "<td class='text-center'><span class='d-block'><strong>" . date('d', strtotime($d)) . "</strong></span>";
                        foreach ($lista as $item) {
                            $dr_inicial = strtotime($item['data_inicial']);
                            $dr_final   = strtotime($item['data_final']);
                            $dt = strtotime($d);

                            if($dt >= $dr_inicial && $dt <= $dr_final){
                                $pessoa = $item['pessoa'];
                                $carro  = $item['nome'];
                                echo "<small class='d-block'>" . $pessoa . " | " .  $carro . "</small>";
                            }
                        }// end foreach
                        echo "</td>";
                    }

            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
</div>