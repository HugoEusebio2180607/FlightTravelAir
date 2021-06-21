<?php


use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class EscalaController extends AuthController
{

    public function index($id){

        $this->loginFilterbyRoles('gestorvoo');

        $voo = Voo::find([$id]);
        $aeroporto = Aeroporto::all();

        return View::make('escala.index', ['voo' => $voo , 'aeroporto' => $aeroporto]);
    }

    public function store(){

        $this->loginFilterbyRoles('gestorvoo');

        $escala = new Escala(Post::getAll());

        if($escala->is_valid()){
            $this->index($escala->id_voo);
            $escala->save();
            \ArmoredCore\WebObjects\Redirect::toRoute('escala/index', $escala->id_voo);
        }else{
            \ArmoredCore\WebObjects\Redirect::flashToRoute('escala/create' , ['escala' => $escala], $escala->id_voo);
        }
    }

    public function create() {

        $this->loginFilterbyRoles('gestorvoo');

        $aeroporto = Aeroporto::all();
        $voo = Voo::all();
        return \ArmoredCore\WebObjects\View::make('escala/create', ['voo' => $voo , 'aeroporto' => $aeroporto]);
    }

    public function edit($id){

        $this->loginFilterbyRoles('gestorvoo');
        $aeroporto = Aeroporto::all();
        $voo = Voo::all();
        $escala = Escala::find([$id]);

        if(is_null($escala)){

        }else{
            return View::make('escala.edit', ['escala' => $escala , 'aeroporto' => $aeroporto , 'voo' => $voo]);
        }
    }

    public function update($id){

        $this->loginFilterbyRoles('gestorvoo');

        $escala = Escala::find([$id]);
        $escala->update_attributes(Post::getAll());


        if($escala->is_valid()){
            $this->index($escala->id_voo);
            $escala->save();
            Redirect::toRoute('escala/index', $escala->id_voo);
        }else{
            Redirect::flashToRoute('escala/edit', ['escala' => $escala]);
        }

    }

    public function show($id){

        $this->loginFilterbyRoles('gestorvoo');
        $escala = Escala::find([$id]);

        if (is_null($escala)){

        }else {
            return View::make('escala.show', ['escala' => $escala]);
        }
    }

    public function destroy($id){

        $this->loginFilterbyRoles('gestorvoo');
        $escala = Escala::find([$id]);
        $this->index($escala->id_voo);
        $escala->delete();
         Redirect::toRoute('escala/index/');
    }

}