<?php

namespace App\Http\Controllers\Restaurants;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Models\Item;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ToppingRequest as StoreRequest;
use App\Http\Requests\ToppingRequest as UpdateRequest;

class ToppingCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Topping');
        $this->crud->setRoute('restaurants-admin' . '/toppings');

        if(request()->has('item'))
        {
            $item = Item::findOrFail(request('item'));

        $this->crud->setEntityNameStrings('Extra Option | ' . $item->name, 'Extra Options | '  . $item->name);

         $this->crud->setListView('admin.options.list');
          $this->crud->setCreateView('admin.options.create');

         $this->crud->item = $item;

    } else {
        $this->crud->setEntityNameStrings('Extra Option', 'Extra Options');
    }

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns([
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'itemName', 'label' => 'Menu Item'],
        ]);

         if(request()->has('item'))
        {

            $this->crud->removeColumn( ['name' => 'itemName', 'label' => 'Menu Item']);
        }

        $this->crud->addFields([
            ['name' => 'name', 'label' => 'Name  <span style="color: red;">*</span>' ],

            [ // select_from_array
                'name' => 'select_type',
                'label' => 'Selection Type  <span style="color: red;">*</span>',
                'type' => 'select2_from_array',
                'options' => [0 => 'Choose One', 1 => 'Choose Multiple'],
                'allows_null' => false
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
             ],

            
            [ // Table
                'name' => 'options',
                'label' => 'Choices',
                'type' => 'table',
                'entity_singular' => 'option', // used on the "Add X" button
                'columns' => [
                    'name' => 'Name',
                    'desc' => 'Description (optional)',
                    'price' => 'Price (Rs.)'
                ]
            ],
        ]);

        if(request()->has('item'))
        {
            $item = Item::findOrFail(request('item'));

            $this->crud->addField([  // Select2
               'label' => "Menu Item",
               'type' => 'hidden',
               'name' => 'item_id', // the db column for the foreign key
               'value' => request('item')
              
            ]);

            $this->crud->addClause('where', 'item_id', '=', request('item'));

            $this->data['title'] = 'Extra Options' . ' | ' . $item->name;

        } else {
            $this->crud->addField( [  // Select2
               'label' => 'Menu Item <span style="color: red;">*</span>',
               'type' => 'select2',
               'name' => 'item_id', // the db column for the foreign key
               'entity' => 'item', // the method that defines the relationship in your Model
               'attribute' => 'itemFullName', // foreign key attribute that is shown to user
               'model' => "App\Models\Item" // foreign key model
               
             ]);
        }



        $this->crud->ajax_table = false;

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }


    /**
     * Redirect to the correct URL, depending on which save action has been selected.
     * @param  [type] $itemId [description]
     * @return [type]         [description]
     */
    public function performSaveAction($itemId = null)
    {
        $saveAction = \Request::input('save_action', config('backpack.crud.default_save_action', 'save_and_back'));
        $itemId = $itemId ? $itemId : \Request::input('id');

        switch ($saveAction) {
            case 'save_and_new':
                $redirectUrl = 'restaurants-admin/toppings/create?item=' . $this->crud->entry->item->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'restaurants-admin/toppings'.'/'.$itemId.'/edit';
                if (\Request::has('locale')) {
                    $redirectUrl .= '?locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'restaurants-admin/toppings?item=' . $this->crud->entry->item->id;
                break;
        }

        return \Redirect::to($redirectUrl);
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
