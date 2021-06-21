<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;

class AuthController extends  BaseController
{

    public function  loginFilter(){

        if(!AuthManagement::isUserLogged()){
        Redirect::toRoute('login/login');
        }
    }

    public function loginFilterbyRoles($role){

        if (AuthManagement::isUserLogged()){

            if ($role != AuthManagement::getRoles()){
                Redirect::toRoute('login/login');
            }
        }else{
            Redirect::toRoute('login/login');
        }
    }
}