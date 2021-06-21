<?php


class Voo extends \ActiveRecord\Model
{


    static $has_many =array(
        array('escala', 'className' => 'Escala', 'foreign_key' => 'id_voo')
    );

    static $belongs_to = array(
        array('airportorigem', 'class_name' => 'Aeroporto', 'foreign_key' => 'aeroporto_origem'),
        array('airportodestino', 'class_name' => 'Aeroporto', 'foreign_key' => 'aeroporto_destino'),
    );
}