<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AssembleRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\AssembleRequest as UpdateRequest;
use App\Models\Product;
use App\Models\AssembleProduct;

/**
 * Class AssembleCrudController.
 * @property-read CrudPanel $crud
 */
class AssembleController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Assemble');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/assemble');
        $this->crud->setEntityNameStrings('assemble', 'assembles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'transaction_time',
            'type' => 'datetime',
            'label' => 'Waktu Merakit',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'product_id',
            'type' => 'select',
            'label' => 'Nama Product',
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);

        $this->crud->addColumn([
            'name' => 'quantity',
            'type' => 'number',
            'label' => 'Qty',
            'searchLogic' => false,
        ]);

        $this->crud->addColumn([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Harga',
            'searchLogic' => false,
        ]);

        $this->crud->addField([
            'name' => 'transaction_time',
            'type' => 'datetime_picker',
            'label' => 'Waktu Merakit',
            'default' => now(),
        ]);

        $this->crud->addField([
            'name' => 'product_id',
            'type' => 'select2',
            'label' => 'Nama Product',
            'options' => function ($model) {
                return $model->where('tosell', true)->where('raw', false)->get();
            },
            'entity' => 'product', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Product", // foreign key model
        ]);

        $this->crud->addField([
            'name' => 'quantity',
            'type' => 'number',
            'label' => 'Qty',
            'default' => 1,
        ]);

        $this->crud->addField([
            'name' => 'memo',
            'type' => 'textarea',
            'label' => 'Memo',
        ]);

        $this->crud->child_resource_included = ['select' => false, 'number' => false];

        $this->crud->addField([
            'name' => 'products',
            'label' => 'Bahan Baku',
            'type' => 'child',
            'columns' => [
                [
                    'label' => 'Nama Bahan Baku',
                    'type' => 'child_select',
                    'name' => 'product_id',
                    'entity' => 'product',
                    'attribute' => 'description',
                    'size' => '3',
                    'model' => "App\Models\Product",
                    'options' => function ($model) {
                        return $model->where('raw', true)->get();
                    },
                ],
                ['name' => 'qty',
                    'label' => 'Quantity',
                    'type' => 'child_number',
                    'default' => 1,
                ],
            ],
            'min' => 1,
        ]);

        // add asterisk for fields that are required in AssembleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $request['user_id'] = backpack_auth()->user()->id;
        $products = json_decode($request->products);
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        foreach ($products as $item) {
            $productId = $item->product_id;
            $price = Product::find($productId)->price;
            
            $assembleProduct = new AssembleProduct();
            $assembleProduct->assemble_id = $this->crud->entry->id;
            $assembleProduct->product_id = $productId;
            $assembleProduct->quantity = $item->qty;
            $assembleProduct->price = $price;
            $assembleProduct->save();
        }

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $request['user_id'] = backpack_auth()->user()->id;
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
