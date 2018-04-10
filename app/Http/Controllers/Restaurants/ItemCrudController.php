<?php

namespace App\Http\Controllers\Restaurants;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ItemRequest as StoreRequest;
use App\Http\Requests\ItemRequest as UpdateRequest;

class ItemCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Item');
        $this->crud->setRoute('restaurants-admin' . '/items');
        $this->crud->setEntityNameStrings('item', 'items');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns([
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'price', 'label' => 'Price'],
            
            
        ]);

        if(!auth()->user()->isRestaurant())
           {
              $this->crud->addColumn(['name' => 'restaurantName', 'label' => 'Restaurant Name']);

            } 

        $this->crud->addColumn(['name' => 'cuisineName', 'label' => 'Cuisine']);


        $this->crud->addFields([
             [   // Browse
                    'name' => 'photo',
                    'label' => 'Item Photo',
                    'type' => 'browse',
                    'tab' => 'General'
                ],

            ['name' => 'name', 'label' => 'Name <span style="color: red;">*</span>', 'tab' => 'General'],
            ['name' => 'description', 'label' => 'Decription/Ingredients <span style="color: red;">*</span>', 'tab' => 'General'],
            ['name' => 'slug', 'label' => 'Slug', 'type' => 'hidden', 'value' => 'a', 'tab' => 'General'],
            [  // Select2
               'label' => 'Cuisine  <span style="color: red;">*</span>',
               'type' => 'select2',
               'name' => 'cuisine_id', // the db column for the foreign key
               'entity' => 'cuisine', // the method that defines the relationship in your Model
               'attribute' => 'nameTree', // foreign key attribute that is shown to user
               'model' => "App\Models\Cuisine", // foreign key model
               'tab' => 'General'
            ],

            ['name' => 'price', 'label' => 'Price  <span style="color: red;">*</span>', 'tab' => 'General', 'type' => 'number', 'attributes' => ["min" => 1]],
            
            [ // select_from_array
                'name' => 'is_veg  <span style="color: red;">*</span>',
                'label' => "Veg or Non Veg",
                'type' => 'select2_from_array',
                'options' => [0 => 'Non Veg', 1 => 'Veg'],
                'allows_null' => false,
                'default' => 1,
                'tab' => 'General'
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],

            [ // Table
                'name' => 'sizes',
                'label' => 'Available Sizes',
                'type' => 'table',
                'entity_singular' => 'option', // used on the "Add X" button
                'columns' => [
                    'name' => 'Name (Ex. Half/13 Inch etc.)',
                    'price' => 'Price (Rs.)'
                ],
                'tab' => 'Available Sizes'
            ],

            [ // Table
                'name' => 'toppings',
                'label' => 'Extra Options/Additions',
                'type' => 'table',
                'entity_singular' => 'option', // used on the "Add X" button
                'columns' => [
                    'name' => 'Name',
                    'desc' => 'Description (optional)',
                    'price' => 'Price (Rs.)'
                ],
                'tab' => 'Options/Addition'
            ],
          
        ]);


         if(!auth()->user()->isRestaurant())
           {
              $this->crud->addField([  // Select2
                   'label' => "Restaurant *",
                   'type' => 'select2',
                   'name' => 'restaurant_id', // the db column for the foreign key
                   'entity' => 'restaurant', // the method that defines the relationship in your Model
                   'attribute' => 'name', // foreign key attribute that is shown to user
                   'model' => "App\Models\Restaurant",
                   'tab' => 'General'
                ]);

            } else {
                $this->crud->addField([  // Select2
                   'label' => "Restaurant",
                   'type' => 'hidden',
                   'name' => 'restaurant_id', 
                   'value' => auth()->user()->restaurant->id
                ]);
            }


       if(auth()->user()->isRestaurant())
       {
          $this->crud->addClause('where', 'restaurant_id', '=', auth()->user()->restaurant->id);
       } 

      
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
