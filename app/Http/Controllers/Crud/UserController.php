<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use App\Models\User;

class UserController extends CrudController
{


    public function config()
    {
        $this->crud->setModel(User::class);
        $this->crud->setEntity('users');
        $this->crud->query = $this->crud->query;
    }


    public function setupIndex()
    {
        $this->crud->setColumn('name');
        $this->crud->setColumn('email');
        $this->crud->setColumn('email_verified_at');
        $this->crud->setColumn('created_at');
        $this->crud->setColumn('action');
    }


    public function setupCreate()
    {

        $this->crud->setField(
            [
                'name' => 'name',
                'validation' => 'required|string',
            ]
        );

        $this->crud->setField(
            [
                'name' => 'email',
                'type' => 'email',
                'validation' => 'required|string',
            ]
        );


        $this->crud->setField(
            [
                'name' => 'password',
                'type' => 'password',
                'validation' => 'required | string',
            ]
        );








    }


    public function setupEdit()
    {
        $this->setupCreate();
    }


}
