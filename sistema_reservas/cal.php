<?php

class Calendario {
    private $date;
    private $first_day;
    private $last_day;
    private $rows;
    private $start_date;
    private $end_date;
    private $date_diff;
    private $month_days;

    public function __construct($date){
        $this->setDate($date);
    }


    public function setDate($date){
        $this->date = $date;
        $this->first_day = date('w', strtotime( $date ));
        $this->month_days = date('t', strtotime( $date ));
        $this->rows = ceil(( $this->first_day + $this->month_days) / 7);
        $this->first_day *= -1;
        $this->start_date = date('Y-m-d', strtotime( $this->first_day . ' days', strtotime( $date )));
        $this->end_date = date('Y-m-d', strtotime(( $this->first_day + ( $this->rows * 7) - 1) . ' days', strtotime( $date )));
        $this->last_day = date("Y-m-t", strtotime( $date ));
        $datediff = date_diff( date_create( $this->last_day ), date_create( $this->end_date ) );
        $this->date_diff = $datediff->days;
    }

    public function getStartDate(){
        return $this->start_date;
    }

    public function getEndDate(){
        return $this->end_date;
    }


    public function showCalendar($lista){
        $str = "<div class='col-sm-12'>" .
                    "<table class='table table-sm table-bordered thead-light'>" .
                        "<thead class='thead-dark'>" .
                            "<th colspan='7'>" . date('F/Y', strtotime($this->date)) . "</th>" .
                                "</thead>" .
                                "<thead class='thead-light'>" .
                                    "<th class='text-center'>Domingo</th>" .
                                    "<th class='text-center'>Segunda-feira</th>" .
                                    "<th class='text-center'>Terça-feira</th>" .
                                    "<th class='text-center'>Quarta-feira</th>" .
                                    "<th class='text-center'>Quinta-feira</th>" .
                                    "<th class='text-center'>Sexta-feira</th>" .
                                    "<th class='text-center'>Sábado</th>" .
                                "</thead>" .
                                "<tbody>";
                                    for ($i=0; $i < $this->rows; $i++) {
                                        $str .= "<tr>";
                                        for ($j=0; $j < 7; $j++){
                                            $d = date('Y-m-d', strtotime(( $j+($i*7)) . ' days', strtotime($this->start_date)) );

                                                if( $i == 0 && $j + $this->first_day < 0 ) {
                                                    $str .= "<td class='text-center'></td>";
                                                } else if ($i == $this->rows-1 && $j >= 7- $this->date_diff ){
                                                    $str .= "<td class='text-center  alert alert-light'></td>";
                                                }
                                                else {
                                                    $str .= "<td class='text-center'><span class='d-block'><strong>" . date('d', strtotime($d)) . "</strong></span>";
                                                    foreach ($lista as $item) {
                                                        $dr_inicial = strtotime($item['data_inicial']);
                                                        $dr_final   = strtotime($item['data_final']);
                                                        $dt = strtotime($d);

                                                        if($dt >= $dr_inicial && $dt <= $dr_final){
                                                            $pessoa = $item['pessoa'];
                                                            $carro  = $item['nome'];
                                                            $str .= "<small class='d-block'>" . $pessoa . " | " .  $carro . "</small>";
                                                        }
                                                    }// end foreach
                                                    $str .= "</td>";
                                                }

                                        }
                                        $str .= "</tr>";
                                    } //e nd for
                                $str .= "</tbody>" .
                            "</table>" .
                        "</div>";
                        return $str;
    } // end showCalendar


}