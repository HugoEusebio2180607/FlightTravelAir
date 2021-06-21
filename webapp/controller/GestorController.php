<?php


use ArmoredCore\WebObjects\View;

class GestorController extends AuthController
{

    public function index(){
        $this->loginFilterbyRoles('gestorvoo');
        return View::make('gestor.index');


    }
}