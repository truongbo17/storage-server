<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait GenerateTokenOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupGenerateTokenRoutes($segment, $routeName, $controller)
    {
        Route::patch($segment . '/{id}', [
            'as'        => $routeName . '.generatetoken',
            'uses'      => $controller . '@generatetoken',
            'operation' => 'generatetoken',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupGenerateTokenDefaults()
    {
        $this->crud->allowAccess('generatetoken');

        $this->crud->operation('generatetoken', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'generatetoken', 'view', 'crud::buttons.generatetoken', 'end');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function generatetoken()
    {
        $this->crud->hasAccessOrFail('generatetoken');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'generatetoken ' . $this->crud->entity_name;

        // load the view
        return view("crud::operations.generatetoken", $this->data);
    }
}
