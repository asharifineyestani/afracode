<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use Afracode\CRUD\App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends CrudController
{
    public function config()
    {
        $this->crud->setModel(Message::class);
        $this->crud->SetEntity('messages');
    }


    public function setupIndex()
    {
        $this->crud->setColumn('id');
        $this->crud->setColumn('email');
        $this->crud->setColumn('title');
        $this->crud->setColumn('created_at');
        $this->crud->setColumn('action');
    }


    public function setupCreate()
    {

        $this->crud->setField([
            'name' => 'email',
            'type' => 'email',
        ]);

        $this->crud->setField([
            'name' => 'title'
        ]);

        $this->crud->setField([
            'name' => 'body',
            'type' => 'textarea',
        ]);
    }
}
