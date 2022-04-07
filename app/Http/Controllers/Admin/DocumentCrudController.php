<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Exception;

/**
 * Class DocumentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DocumentCrudController extends CrudController
{
    use ListOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     * @throws Exception
     */
    public function setup()
    {
        CRUD::setModel(Document::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/document');
        CRUD::setEntityNameStrings('document', 'documents');
        CRUD::enableDetailsRow();
    }

    public function showDetailsRow($id)
    {
        $document = Document::findOrFail($id);
        return view('crud::details_row', compact('document'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text'
            ],
            [
                'name' => 'title',
                'type' => 'text'
            ],
            [
                'name' => 'referer',
                'type' => 'url_reducer'
            ],
            [
                'name' => 'download_link',
                'type' => 'url_reducer'
            ],
        ]);

        $this->crud->addFilter([
            'name' => 'id',
            'type' => 'text',
            'label' => 'ID',
        ], false, function ($value) {
            $this->crud->addClause('where', 'id', $value);
        });
    }
}
