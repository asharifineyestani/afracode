<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use App\Models\Post;
use Hekmatinasser\Verta\Facades\Verta;

class PostController extends CrudController
{


    public function config()
    {
        $this->crud->setModel(Post::class);
        $this->crud->setEntity('posts');
    }


    public function setupIndex()
    {
        $this->crud->setColumn('id' );
        $this->crud->setColumn('title' );
        $this->crud->setColumn('created_at');
        $this->crud->setColumn('action');
    }



    public function setupCreate()
    {

        $this->crud->setField(
            [
                'name' => 'title',
                'validation' => 'required | string',
            ]
        );


        $this->crud->setField(
            [
                'name' => 'body',
                'type' => 'textarea',
                'validation' => 'required|string',
            ]
        );



    }


    public function setupEdit()
    {
        $this->setupCreate();
    }

}
