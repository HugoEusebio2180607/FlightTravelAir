<?php


use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;

class AuthManagement implements IAuthManagement
{

    static public function  isUserLogged(){
        if (Session::has('userid')){
            return true;
        }else{
            return false;

        }
    }

    static  public function getID(){
        if(Session::has('userid')){
            return Session::get('userid');
        }else{
            return null;
        }
    }

    public function setLogin($user){
        Session::set('userid', $user->id);
        Session::set('user_roles', $user->roles);
    }

    static public function getRoles(){

        if (Session::has('userid')){
            return Session::get('user_roles');
        }else{
            return null;
        }
    }

    static public function logout(){
        if (self::isUserLogged()){
            Session::destroy();
            Redirect::toRoute('login/login');
        }
    }

}