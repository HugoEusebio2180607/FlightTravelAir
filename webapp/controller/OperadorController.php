<?php


use ArmoredCore\WebObjects\View;

class OperadorController extends AuthController

{
    public function index()
    {
        $this->loginFilterbyRoles('operadorcheckin');
        $voos = Voo::all(array('conditions' => array('id != ?' ,3)));
        return View::make('operador.index' , ['voos' => $voos]);
    }
}