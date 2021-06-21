<?php



use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class AdminController extends AuthController
{

    public function index(){

        $this->loginFilterbyRoles('admin');
        return View::make('admin.index' );
    }


}

