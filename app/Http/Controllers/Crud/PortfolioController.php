<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use App\Models\Portfolio;

class PortfolioController extends CrudController
{
    public function config()
    {
        $this->crud->setModel(Portfolio::class);
        $this->crud->SetEntity('portfolio');
    }


    public function setupIndex()
    {
        $this->crud->setColumn('id');
        $this->crud->setColumn('title');
        $this->crud->setColumn('themeforest_link');
        $this->crud->setColumn('price');
        $this->crud->setColumn('action');
    }


    public function setupCreate()
    {

        $this->crud->setField([
            'name' => 'title'
        ]);

        $this->crud->setField([
            'name' => 'themeforest_link',
            'type' => 'url',
        ]);

        $this->crud->setField([
            'name' => 'price',
            'type' => 'number',
        ]);
    }
}
