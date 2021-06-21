<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class AviaoController extends AuthController
{


    public function index()
    {
        $this->loginFilterbyRoles('gestorvoo');
        $aviao = Aviao::all();
        return View::make('avioes/index', ['aviao' => $aviao]);
    }



    public function create(){
        $this->loginFilterbyRoles('gestorvoo');
        return View::make('avioes.create');
    }

    public function store(){
        $this->loginFilterbyRoles('gestorvoo');

        $aviao  = new Aviao(Post::getAll());

        if($aviao ->is_valid()){
            $aviao ->save();
            Redirect::toRoute('avioes/index');
        }else{
            Redirect::flashToRoute('avioes/create' , ['aviao' => $aviao ]);
        }
    }

    public function edit($id){

        $this->loginFilterbyRoles('gestorvoo');
        $aviao  = Aviao::find([$id]);


        if(is_null($aviao )){

        }else{
            return View::make('avioes.edit' , ['aviao' =>$aviao ]);
        }

    }

    public function update($id)
    {
        $this->loginFilterbyRoles('gestorvoo');

        $aviao  = Aviao::find([$id]);
        $aviao->update_attributes(Post::getAll());

        if($aviao ->is_valid()){
            $aviao ->save();
            Redirect::toRoute('avioes/index');
        } else {
            Redirect::flashToRoute('avioes/edit' ,['aviao' => $aviao ]);
        }


    }

    public function show($id){

        $this->loginFilterbyRoles('gestorvoo');
        $aviao  = Aviao::find([$id]);

        if (is_null($aviao)){

        }else {
            return View::make('avioes.edit' , ['aviao' => $aviao ]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRoles('gestorvoo');
        $aviao  = Aviao::find([$id]);
        $aviao ->delete();
        Redirect::toRoute('avioes/index');
    }
}