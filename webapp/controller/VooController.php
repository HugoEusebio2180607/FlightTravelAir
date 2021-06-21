<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class VooController extends AuthController implements ResourceControllerInterface
{


    public function index()
    {
        $this->loginFilterbyRoles('gestorvoo');
        $voo = Voo::all(array('conditions' => array('id != ?' ,3)));
        return View::make('voos/index', ['voo' => $voo]);
    }



    public function create(){
        $this->loginFilterbyRoles('gestorvoo');
        $aeroportos = AeroportoController::viewAeroporto();
        return View::make('voos.create', ['aeroporto' => $aeroportos]);
    }

    public function store(){
        $this->loginFilterbyRoles('gestorvoo');

        $voo  = new Voo(Post::getAll());

        if($voo ->is_valid()){
            $voo ->save();
            Redirect::toRoute('voos/index');
        }else{
            Redirect::flashToRoute('voos/create' , ['voo ' => $voo ]);
        }
    }

    public function edit($id){

        $this->loginFilterbyRoles('gestorvoo');
        $voo  = Voo::find([$id]);
        $aeroportos = AeroportoController::viewAeroporto();


        if(is_null($voo )){

        }else{
            return View::make('voos.edit' , ['voo' =>$voo ,'aeroporto' =>$aeroportos]);
        }

    }

    public function update($id)
    {
        $this->loginFilterbyRoles('gestorvoo');

        $voo  = Voo::find([$id]);
        $voo->update_attributes(Post::getAll());

        if($voo ->is_valid()){
            $voo ->save();
            Redirect::toRoute('voos/index');
        } else {
            Redirect::flashToRoute('voos/edit' ,['voo' => $voo ]);
        }


    }

    public function show($id){

        $this->loginFilterbyRoles('gestorvoo');
        $voo  = Voo::find([$id]);

        if (is_null($voo )){

        }else {
            return View::make('voos.edit' , ['voo' => $voo ]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRoles('gestorvoo');
        $voo  = Voo::find([$id]);
        $voo ->delete();
        Redirect::toRoute('voos/index');
    }
}