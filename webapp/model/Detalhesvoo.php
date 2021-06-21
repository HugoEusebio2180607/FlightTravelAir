<?php


class Detalhesvoo extends \ActiveRecord\Model
{


    static $validates_presence_of = array(

        array('id_escala' , 'message' => 'obrigatorio'),
        array('id_aviao' , 'message' => 'obrigatorio'),
        array('passageiros' , 'message' => 'obrigatorio'),
    );


}