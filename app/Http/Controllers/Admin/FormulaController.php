<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormulaRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FormulaRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class FormulaCrudController.
 * @property-read CrudPanel $crud
 */
class FormulaController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Formula');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/formula');
        $this->crud->setEntityNameStrings('formula', 'formulas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'product_id',
            'type' => 'select',
            'label' => 'Nama Product',
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);

        $this->crud->addField([
            'name' => 'product_id',
            'type' => 'select2',
            'label' => 'Nama Product',
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);

        // add asterisk for fields that are required in FormulaRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
