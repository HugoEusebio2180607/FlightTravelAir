<?php


class Escala extends \ActiveRecord\Model
{

    static $validates_presence_of = array(

        array('aeroporto_origem', 'message' => 'Obrigatorio'),
        array('aeroporto_destino','message' => 'Obrigatorio'),
        array('id_voo', 'message' => 'Obrigatorio'),
        array('hora_origem', 'message' => 'Obrigatorio'),
        array('hora_destino', 'message' => 'Obrigatorio'),
        array('data_origem', 'message' => 'Obrigatorio'),
        array('data_final', 'message' => 'Obrigatorio'),
        array('distancia', 'message' => 'Obrigatorio'),
    );


    static $belongs_to = array(
        array('airportorigem', 'class_name' => 'Aeroporto', 'foreign_key' => 'aeroporto_origem'),
        array('airportodestino', 'class_name' => 'Aeroporto', 'foreign_key' => 'aeroporto_destino'),
    );

}