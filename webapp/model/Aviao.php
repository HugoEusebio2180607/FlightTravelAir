<?php


class Aviao extends \ActiveRecord\Model
{


    static  $validates_presence_of = array(
        array(
            'referencia',
            'message' => 'obrgatorio'
        ),
        array(
            'lotacao',
            'message' => 'obrigatorio'
        ),
        array(
            'tipo_aviao',
            'message' => 'obrigatorio'
        )
    );
}