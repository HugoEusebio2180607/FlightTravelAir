<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class AeroportoController extends AuthController implements ResourceControllerInterface
{


    public function index()
    {
       $this->loginFilterbyRoles('admin');
       $aeroporto = Aeroporto::all();
       return View::make('aeroporto/index', ['aeroporto' => $aeroporto]);
    }

    public static function viewAeroporto(){

        $aeroportos = Aeroporto::all();
        return $aeroportos;
    }

    public function create(){
        $this->loginFilterbyRoles('admin');
        return View::make('aeroporto.create');
    }

    public function store(){
        $this->loginFilterbyRoles('admin');

        $aeroporto = new Aeroporto(Post::getAll());

        if($aeroporto->is_valid()){
            $aeroporto->save();
            Redirect::toRoute('aeroporto/index');
        }else{
            Redirect::flashToRoute('aeroporto/create' , ['aeroporto' => $aeroporto]);
        }
    }

    public function edit($id){

        $this->loginFilterbyRoles('admin');
        $aeroporto = Aeroporto::find([$id]);

        if(is_null($aeroporto)){

        }else{
            return View::make('aeroporto.edit' , ['aeroporto' =>$aeroporto]);
        }

    }

    public function update($id)
    {
        $this->loginFilterbyRoles('admin');

        $aeroporto = Aeroporto::find([$id]);
        $aeroporto->update_attributes(Post::getAll());

        if($aeroporto->is_valid()){
            $aeroporto->save();
            Redirect::toRoute('aeroporto/index');
        } else {
            Redirect::flashToRoute('aeroporto/edit' ,['aeroporto' => $aeroporto]);
        }


    }

    public function show($id){

        $this->loginFilterbyRoles('admin');
        $aeroporto = Aeroporto::find([$id]);

        if (is_null($aeroporto)){

        }else {
            return View::make('aeroporto.edit' , ['aeroporto' => $aeroporto]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRoles('admin');
        $aeroporto = Aeroporto::find([$id]);
        $aeroporto->delete();
        Redirect::toRoute('aeroporto/index');
    }
}