<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class LoginController extends BaseController
{
    public function  loginpassageiro(){
       View::make('login/login');
    }

    public function doLogin(){
        $username = Post::get('username');
        $password = Post::get('password');

        $login = User::find_by_username_and_password($username, $password);

        if(!is_null($login)){
            $authmgr = new AuthManagement();
            $authmgr->setLogin($login);

            $roles = AuthManagement::getRoles();

            switch ($roles){
                case 'admin':
                    Redirect::toRoute('admin/index');
                    break;
                case 'gestorvoo':
                    Redirect::toRoute('gestor/index');
                    break;
                case 'operadorcheckin':
                    Redirect::toRoute('operador/index');
                    break;
                case 'passageiro':
                    Redirect::toRoute('passageiro/index',  $login->id);
                    break;

                default:
                    Redirect::toRoute('login/login');
                    break;
            }
        }
        else{
            Redirect::toRoute('login/login');
        }
    }


    public function registarPassageiro(){
        $user = new User(Post::getAll());
        $user->roles = 'passageiro';

        if ($user->is_valid()){
            $user->save();
            Redirect::toRoute('login/login');
        }else{

            Redirect::flashToRoute('login/signup' , ['user' => $user]);
        }
    }

    public function registoform(){
        View::make('login.signup');
    }

    public function doLogout(){
        AuthManagement::logout();
    }
}