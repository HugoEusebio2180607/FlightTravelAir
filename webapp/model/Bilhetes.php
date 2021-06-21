<?php


use ActiveRecord\Model;

class Bilhetes extends Model
{


    static $validates_presence_of = array(
        array('id_user', 'message' => 'obrigatorio'),
        array('idavoo', 'message' => 'obrigatorio'),
        array('preco', 'message' => 'obrigatorio')
    );

    static $has_many = array(
        array('users', 'class_name' => 'User', 'foreign_key' => 'id_user')
    );


    static  $belongs_to = array(
        array('bilheteida',  'class_name' => 'Voo', 'foreign_key' => 'idavoo'),
        array('bilhetevolta',  'class_name' => 'Voo', 'foreign_key' => 'voltavoo'),
        array('bilheteuser',  'class_name' => 'User', 'foreign_key' => 'id_user'),
    );
}