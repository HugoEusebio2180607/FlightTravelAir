<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class BilhetesController extends AuthController
{


    public function index($id)
    {
        $this->loginFilterbyRoles('operadorcheckin');
        $voos = Voo::find([$id]);
        $bilhetes = Bilhetes::all(array('conditions' => array('idavoo = ? and checkin IS NULL', $id )));
        return View::make('operador.checkin' , ['bilhetes' => $bilhetes , 'voos' => $voos]);
    }


    public function create()
    {
        // TODO: Implement create() method.
    }


    public function store($id)
    {
        $this->loginFilterbyRoles('operadorcheckin');

        $bilhetes= Bilhetes::find([$id]);
        $bilhetes->checkin = $_SESSION['userid'];

        if ($bilhetes->is_valid()){
            $bilhetes->save();
            Redirect::toRoute('operador/checkin' , $bilhetes->idavoo);
        }else{
            return View::make('operador/checkin' , ['bilhetes' => $bilhetes]);
        }
    }


    public function show($id)
    {
        $this->loginFilterbyRoles('operadorcheckin');
        $bilhetes = Bilhetes::find($id);

        if (is_null($bilhetes)){

        }else {
            return View::make('bilhetes.show', ['bilhetes' => $bilhetes]);
        }
    }


    public function edit($id)
    {
        // TODO: Implement edit() method.
    }


    public function update($id)
    {
        // TODO: Implement update() method.
    }


    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}