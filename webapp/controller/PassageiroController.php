<?php


use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PassageiroController extends AuthController
{

    public function  index($id){
        $this->loginFilterbyRoles('passageiro');
        $user = User::find([$id]);
        $escala = Escala::all();
        return View::make('passageiro.index', ['user' => $user , 'escala'=> $escala]);
    }


    public function update($id){
        $this->loginFilterbyRoles('passgeiro');

        $user = User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
           Redirect::toRoute('passageiro/index' ,$user->id);
        } else {
            Redirect::flashToRoute('passageiro/edit' , ['user' => $user] , $user->id);
        }
    }

    public function perfil(){

        $this->loginFilterbyRoles('passageiro');
        $user = User::find([$_SESSION['userid']]);
        return View::make('passageiro.index' , ['user' => $user]);
    }

    public function guardarbilhete($id){

        $this->loginFilterbyRoles('passageiro');
        $aeroporto = Aeroporto::all();
        $user = User::find([$_SESSION['userid']]);

//        var_dump(Post::getAll()); die();
        $bilhetes = new Bilhetes(Post::getAll());
        $bilhetes->id_user = $user->id;
        $data = date('Y-m-d H:m:s',time());
        $bilhetes->data_compra = $data;

        if($bilhetes->idavoo == 0){
            $bilhetes->voltavoo = 3;
        }
        $ida = $this->preco($bilhetes->idavoo);
        if($bilhetes->voltavoo == 0){
            $volta= null;
        }else{
            $volta = $this->preco($bilhetes->voltavoo);
        }

        $bilhetes->preco = $ida +$volta;

        if ($bilhetes->is_valid()){
            $bilhetes->save();

            Redirect::toRoute('passageiro/bilhete' , $bilhetes->id);
        }else {
            $escala = Escala::all(array('conditions' => array('data_final >= ?' ,$data), 'order' => 'data_origem asc'));
            Redirect::flashToRoute('passageiro/bilhete' ,['user' => $user,'bilhetes' => $bilhetes , 'escalas' => $escala, 'aeroportos' => $aeroporto]);
        }
    }

    public  function compra(){
        $this->loginFilterbyRoles('passageiro');
        $aeroporto = Aeroporto::all(array('conditions' => array('id!=?' ,7)));
        $voos =Voo::all(array('conditions' => array('id!=?' ,3)));
        $user = User::find([$_SESSION['userid']]);
        $data = date('Y-m-d',time());
        $escala = Escala::all(array('conditions' => array('data_final >= ?', $data) , 'order' => 'data_origem asc'));
        return View::make('passageiro.compra' , ['user' => $user, 'escalas' => $escala , 'aeroportos' => $aeroporto , 'voos'=>$voos]);
    }

    public function bilhete($id) {
        $this->loginFilterbyRoles('passageiro');
        $bilhetes = Bilhetes::find([$id]);
        $bilhteida = Voo::find([$bilhetes->idavoo]);
        $bilhtevota = Voo::find([$bilhetes->voltavoo]);
        return View::make('passageiro.bilhete' , ['bilheteida' => $bilhteida, 'bilhetevolta' => $bilhtevota, 'bilhetes' =>$bilhetes]);

    }

    public function voos(){

        $this->loginFilterbyRoles('passageiro');
        $user = User::find([$_SESSION['userid']]);
        $aeroporto = Aeroporto::all(array('conditions' => array('id != ?' , 7)));
        $data = date('Y-m-d', time());
        $escala = Escala::all(array('conditions' => array('data_final >= ?', $data) , 'order' => 'data_origem asc'));
        return View::make('passageiro.voos', ['user' => $user, 'escalas' => $escala, 'aeroportos' => $aeroporto]);
    }


    public function preco($id){
        //var_dump($id); die();
        $voos = Voo::find_by_id($id);
        return $voos->custo_voo;
    }

    public function edit($id){

        $this->loginFilterbyRoles('passageiro');
        $user = User::find([$id]);

        if (is_null($user)) {

        }else {
            return View::make('passageiro/edit', ['user' => $user]);
        }
    }

    public function selectcompraend(){

        $this->loginFilterbyRoles('passageiro');
        $origem = Post::get('origem');
        $destino = Post::get('destino');
        $data = date('Y-m-d', time());
        $aeroporto = Aeroporto::all();
        $voos = Voo::all();
        $escala = Escala::all(array('conditions' => array('data_final  >= ?',$data),'order' => 'data_origem asc'));
        $user = User::find([$_SESSION['userid']]);
        if ($origem == 0 ){
            return  View::make('passageiro.compra' , ['user' => $user , 'escalas' => $escala, 'aeroporto' => $aeroporto , 'voos' =>$voos]);
        }else{
            $escala = Escala::all(array('conditions' => array('aeroporto_origem = ? and aeroporto_destino >= ?' ,$origem , $destino ) , 'order' => 'data_origem asc'));
        }
        return View::make('passageiro.compra', ['user' => $user, 'escalas' => $escala, 'aeroportos' => $aeroporto, 'voos' => $voos]);
    }

    public function selectcompratime(){

        $this->loginFilterbyRoles('passageiro');
        $partida = Post::get('origem');
        $chegada = Post::get('destino');
        $data = date('Y-m-d', time());
        $aeroporto = Aeroporto::all();
        $voos = Voo::all();
        $user = User::find([$_SESSION['userid']]);
        if ($partida == "" ){
            $escala = Escala::all(array('conditions' => array('data_final = ? ' ,$data),'order' => 'data_origem asc'));
        }else{
            $escala = Escala::all(array('conditions' => array('aeroporto_origem = ? and aeroporto_destino >= ?',$partida, $chegada),'order' => 'data_origem asc'));
        }
        return View::make('passageiro.bilhete', ['user' => $user, 'escalas' => $escala, 'aeroportos' => $aeroporto, 'voos' => $voos]);
    }

    public function selectorigem(){

        $this->loginFilterbyRoles('passageiro');
        $select = Post::get('origem');
        $data = date('Y-m-d', time());
        $aeroporto = Aeroporto::all();
        if ($select == 0){
            $escala = Escala::all(array('conditions' => array('data_final = ? ' ,$data) ,'order' => 'data_origem asc'));
        }else{
            $escala = Escala::all(array('conditions' => array('aeroporto_origem = ? and data_final >= ? ' ,$data , $select) ,'order' => 'data_origem asc'));
        }
        return View::make('passageiro.voos', ['escalas' => $escala , 'aeroportos' => $aeroporto]);
    }

    public function selectdestino(){
        $this->loginFilterbyRoles('passageiro');
        $select = Post::get('destino');
        $data = date('Y-m-d', time());
        $aeroporto = Aeroporto::all();
        if ($select == 0){
            $escala = Escala::all(array('conditions' => array('data_final = ? ' ,$data) ,'order' => 'data_origem asc'));
        }else{
            $escala = Escala::all(array('conditions' => array('aeroporto_destino = ? and data_final >= ? ' ,$data , $select) ,'order' => 'data_origem asc'));
        }
        return View::make('passageiro.voos', ['escalas' => $escala , 'aeroportos' => $aeroporto]);
    }

    public function historico(){
        $this->loginFilterbyRoles('passageiro');
        $user = User::find([$_SESSION['userid']]);
        $bilhetes = Bilhetes::all(array('conditions' => array('id_user = ?' ,$user->id)));
        return View::make('passageiro.historico' , ['bilhetes' => $bilhetes]);
    }

}