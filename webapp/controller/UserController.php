<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class UserController extends AuthController implements ResourceControllerInterface
{
    public function index()
    {
        $this->loginFilterbyRoles('admin');
        $user = User::all(array('conditions' => array('roles != ?', 'passageiro')));
        return View::make('user.index', ['user' => $user]);
    }

    public function create()
    {
        $this->loginFilterbyRoles('admin');
        View::make('user.create');
    }

    public function store()
    {
        $this->loginFilterbyRoles('admin');

        $user = new User(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('user/create', ['user' => $user]);
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function edit($id)
    {
        $this->loginFilterbyRoles('admin');
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('user/edit', ['user' => $user]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRoles('admin');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $user = User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('user/edit', ['user' => $user]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRoles('admin');
        $user = User::find([$id]);
        $user->delete();
        Redirect::toRoute('user/index');
    }

}