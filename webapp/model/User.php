<?php


use ActiveRecord\Model;

class User extends Model
{
    static $validates_presence_of = array(

        array(
            'nome',
            'message' => '0 nome é obrigatorio'
        ),
        array(
            'email',
            'message' => '0 email é obrigatorio'
        ),
        array(
            'morada',
            'message' => 'A morada é obrigatorio'
        ),
        array(
            'nif',
            'message' => 'o nif  é obrigatoria'
        ),
        array(
            'telefone',
            'message' => '0 telefone é obrigatorio'
        ),
        array(
            'username',
            'message' => '0 username é obrigatorio'
        ),
        array(
            'password',
            'message' => 'A password é obrigatoria'
        ),
//        array(
//            'roles',
//            'message' => 'A role é obrigatoria'
//        ),
    );

    static $validates_uniqueness_of = array(
      array(
          'username',
          'message' => 'Ja existe um utilizador com este username.'
      ),
      array(
          'email',
          'message' => 'Ja existe um utlizador com email.'
      )
    );



    static $validates_inclusion_of = array(
        array('roles', 'in' => array('passageiro','operadorcheckin', 'gestorvoo', 'admin'))
    );

}