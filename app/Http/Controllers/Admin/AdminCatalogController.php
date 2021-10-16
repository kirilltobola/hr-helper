<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCatalogRequest;
use App\Models\Cv;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminCatalogController extends Controller
{
    private function getModel(string $modelAlias)
    {
        return config("admin.catalog.$modelAlias");
    }

    public function index()
    {
        $models = config('admin.catalog');
        return view(
             'admin.dashboard',
            ['models' => array_keys($models)]
        );
    }

    public function show(string $modelAlias)
    {
        $model = $this->getModel($modelAlias);
        return view(
            'admin.catalog.show',
            [
                'modelAlias' => $modelAlias,
                'attributes' => ['id', 'name'],
                'models' => $model::all(),
            ]
        );
    }

    public function create(string $modelAlias)
    {
        return view(
            'admin.catalog.create',
            [
                'modelAlias' => $modelAlias,
                'attributes' => ['name'],
            ]
        );
    }

    public function store(AdminCatalogRequest $request, string $modelAlias): RedirectResponse
    {
        $model = $this->getModel($modelAlias);
        $model::create($request->except('_token'));

        return redirect()->route('admin.show', ['model' => $modelAlias]);
    }

    public function edit(string $modelAlias, int $id)
    {
        $model = $this->getModel($modelAlias);
        $instance = $model::find($id);
        return view(
            'admin.catalog.edit',
            [
                'modelAlias' => $modelAlias,
                'id' => $id,
                'attributes' => ['name'],
                'instance' => $instance
            ]
        );
    }

    public function update(AdminCatalogRequest $request, string $modelAlias, int $id): RedirectResponse
    {
        $model = $this->getModel($modelAlias);
        $instance = $model::find($id);
        $instance->update($request->except('_token'));

        return redirect()->route('admin.show', ['model' => $modelAlias]);
    }

    public function delete(string $modelAlias, int $id)
    {
        $model = $this->getModel($modelAlias);
        $canDelete = Cv::where($modelAlias.'_id', '=', $id)->get()->count();

        return view(
            'admin.catalog.delete',
            [
                'model' => $modelAlias,
                'change' => $model::all()->except([$id]),
                'id' => $id,
                'canDelete' => $canDelete
            ]
        );
    }

    public function destroy(Request $request, string $modelAlias, int $id): RedirectResponse
    {
        if ($request->input('change')) {
            $this->change($modelAlias, $id, $request->input('change'));
        }

        $model = $this->getModel($modelAlias);
        $model::find($id)->delete();
        return redirect()->route('admin.show', ['model' => $modelAlias]);
    }

    private function change(string $modelAlias, int $id, int $newId)
    {
        $newModel = $this->getModel($modelAlias)::find($newId);
        $cvs = Cv::where($modelAlias.'_id', '=', $id)->get();
        foreach ($cvs as $cv) {
            $cv->$modelAlias = $newModel;
            $cv->save();
        }
    }
}
