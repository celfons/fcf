<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

class UsersController extends AppController
{

     public function index()
     {
        //$this->set('users', $this->Users->find('all'));
    }

    public function doc()
     {
        
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function mail(){
       if ($this->request->is('post')) {
          $email = new Email('default');
          $email->from(['fcfsei@gmail.com' => 'Meu Site'])
          ->to('fcfsei@gmail.com')
          ->subject($this->request->data('email'))
          ->send($this->request->data('msg'));
       }
    }

   public function add(){

    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->data);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));
            return $this->redirect(['action' => 'add']);
        }
        $this->Flash->error(__('Email already existed.'));
    }
    $this->set('user', $user);
   }

public function beforeFilter(Event $event){
    parent::beforeFilter($event);
    // Permitir aos usu�rios se registrarem e efetuar logout.
    // Voc� n�o deve adicionar a a��o de "login" a lista de permiss�es.
    // Isto pode causar problemas com o funcionamento normal do AuthComponent.
    $this->Auth->allow(['logout','add','index','form','doc']);
}

public function login(){
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('Usuario ou senha invalido, tente novamente'));
    }
}

public function logout(){
    return $this->redirect($this->Auth->logout());
}

}
