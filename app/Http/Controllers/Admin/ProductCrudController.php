<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class ProductCrudController.
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/product');
        $this->crud->setEntityNameStrings('product', 'products');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'text',
            'label' => 'Nama Barang',
        ]);

        $this->crud->addColumn([
            'name' => 'unit',
            'type' => 'text',
            'label' => 'Satuan',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'cost_price',
            'type' => 'number',
            'label' => 'Harga Beli',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Harga Jual',
            'searchLogic' => false,
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'text',
            'label' => 'Nama Barang',
        ]);

        $this->crud->addField([
            'name' => 'unit',
            'type' => 'text',
            'label' => 'Satuan',
        ]);

        $this->crud->addField([
            'name' => 'cost_price',
            'type' => 'number',
            'label' => 'Harga Beli',
            'prefix' => 'Rp',
        ]);

        $this->crud->addField([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Harga Jual',
            'prefix' => 'Rp',
        ]);

        $this->crud->addField([
            'name' => 'tobuy',
            'type' => 'checkbox',
            'label' => 'Untuk dibeli',
        ]);

        $this->crud->addField([
            'name' => 'tosell',
            'type' => 'checkbox',
            'label' => 'untuk dijual',
        ]);

        $this->crud->addField([
            'name' => 'raw',
            'type' => 'checkbox',
            'label' => 'Bahan Baku',
        ]);

        // add asterisk for fields that are required in ProductRequest
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
