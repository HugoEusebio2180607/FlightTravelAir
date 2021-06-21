<?php


class Aeroporto extends \ActiveRecord\Model
{


    static  $validates_presence_of = array(
      array('nome',
             'message' => 'enche o campo nome'),

        array('localizacao',
            'message' => 'enche o campo nome')
    );

}