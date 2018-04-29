<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\RestaurantbannerRequest as StoreRequest;
use App\Http\Requests\RestaurantbannerRequest as UpdateRequest;

class RestaurantbannerCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Restaurantbanner');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/restaurantbanners');
        $this->crud->setEntityNameStrings('Restaurant Banner', 'Restaurant Banners');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns([

            [
               'name' => 'image', // The db column name
               'label' => "Restaurant Banner", // Table column heading
               'type' => 'image',
                // 'prefix' => 'folder/subfolder/',
                // optional width/height if 25px is not ok with you
                'height' => '90px',
                'width' => '90px',
            ],

            [
                'name' => 'restaurantName', 'label' => 'Restaurant'
            ]

        ]);

        $this->crud->addFields([

                [   // Upload
                    'name' => 'image',
                    'label' => 'Restaurant Banner  <span style="color: red;">*</span>',
                    'type' => 'upload',
                    'upload' => true,
                    'driver' => 'uploads' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
                ],   

                [  // Select2
                   'label' => 'Restaurant <span style="color: red;">*</span>',
                   'type' => 'select2',
                   'name' => 'restaurant_id', // the db column for the foreign key
                   'entity' => 'restaurant', // the method that defines the relationship in your Model
                   'attribute' => 'name', // foreign key attribute that is shown to user
                   'model' => "App\Models\Restaurant",
                ]

            ]);

        
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
