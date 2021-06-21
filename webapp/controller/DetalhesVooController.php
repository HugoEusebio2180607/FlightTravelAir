<?php


use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class DetalhesVooController extends AuthController
{



    public function index()
    {
        $this->loginFilterbyRoles('gestorvoo');
        $aviao = Aviao::all();
        $detalhes = Detalhesvoo::all();
        return View::make('detalhesvoo.index' ,['avioes' => $aviao ,'detalhesvoo' => $detalhes]);
    }


    public function create($id)
    {
        $this->loginFilterbyRoles('gestorvoo');
        $avioes = Aviao::all();
        $escalas = Escala::find([$id]);
        return View::make('detalhesvoo.create' , ['avioes' => $avioes, 'escalas' => $escalas]);
    }


    public function store()
    {
      $this->loginFilterbyRoles('gestorvoo');

      $detalhes = new Detalhesvoo(Post::getAll());

      if($detalhes ->is_valid()){
          $detalhes->save();
          Redirect::toRoute('detalhesvoo/index');
      }else {
          Redirect::flashToRoute('detalhesvoo/create' , ['detalhesvoo' => $detalhes]);
      }
    }


    public function show($id)
    {
        $this->loginFilterbyRoles('gestorvoo');
        $detalhes = Detalhesvoo::find([$id]);

        if (is_null($detalhes)){

        }else{
            return View::make('detalhesvoo.show' , ['detalhesvoo' => $detalhes]);
        }
    }


    public function edit($id)
    {
       $this->loginFilterbyRoles('gestorvoo');
       $detalhes = Detalhesvoo::find([$id]);
       $avioes = Aviao::all();
       $esclas = Escala::all();

       if (is_null($detalhes)){

       }else{
           return View::make('detalhesvoo.edit' , ['detalhesvoo' => $detalhes , 'avioes' => $avioes , 'escalas' => $esclas]);
       }
    }


    public function update($id)
    {
        $this->loginFilterbyRoles('gestorvoo');

        $detalhes = Detalhesvoo::find([$id]);
        $detalhes->update_attributes(Post::getAll());

        if($detalhes->is_valid()){
            $detalhes->save();
            Redirect::toRoute('detalhesvoo.index');
        }else {
            Redirect::flashToRoute('detalhesvoo/edit', ['detalhesvoo' => $detalhes]);
        }
    }


    public function destroy($id)
    {
        $this->loginFilterbyRoles('gestorvoo');
        $detalhes = Detalhesvoo::find([$id]);
        $detalhes->delete();
        Redirect::toRoute('detalhesvoo/index');
    }
}