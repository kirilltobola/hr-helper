<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function getModel(string $modelAlias)
    {
        return config("registered_models.$modelAlias.model");
    }

    private function getShowAttributes(string $modelAlias)
    {
        return config("registered_models.$modelAlias.attributes.show");
    }

    private function getStoreAttributes(string $modelAlias)
    {
        return config("registered_models.$modelAlias.attributes.store");
    }

    private function getEditAttributes(string $modelAlias)
    {
        return config("registered_models.$modelAlias.attributes.edit");
    }

    private function getValidationRules(array $keys): array
    {
        $rules = [];
        foreach ($keys as $key) {
            $rules[$key] = 'required';
        }
        return $rules;
    }

    public function index()
    {
        $models = config("registered_models");
        return view(
             'admin.dashboard',
            ["models" => array_keys($models)]
        );
    }

    public function show(string $modelAlias)
    {
        $model = $this->getModel($modelAlias);
        $attributes = $this->getShowAttributes($modelAlias);
        return view(
            'admin.show',
            [
                'modelAlias' => $modelAlias,
                'attributes' => $attributes,
                'models' => $model::all(),
            ]
        );
    }

    public function create(string $modelAlias)
    {
        $attributes = $this->getStoreAttributes($modelAlias);
        return view(
            'admin.create',
            [
                'modelAlias' => $modelAlias,
                'attributes' => $attributes
            ]
        );
    }

    public function store(Request $request, string $modelAlias): RedirectResponse
    {
        $rules = $this->getValidationRules($request->keys());
        $request->validate($rules);

        $model = $this->getModel($modelAlias);
        $model::create($request->except('_token'));
        return redirect()->route('admin.show', ['model' => $modelAlias]);
    }

    public function edit(string $modelAlias, int $id)
    {
        $model = $this->getModel($modelAlias);
        $instance = $model::find($id);
        $attributes = $this->getEditAttributes($modelAlias);
        return view(
            'admin.edit',
            [
                'modelAlias' => $modelAlias,
                'id' => $id,
                'attributes' => $attributes,
                'instance' => $instance
            ]
        );
    }

    public function update(Request $request, string $modelAlias, int $id): RedirectResponse
    {
        $rules = $this->getValidationRules($request->keys());
        $request->validate($rules);

        $model = $this->getModel($modelAlias);
        $instance = $model::find($id);
        $instance->update($request->except('_token'));
        return redirect()->route('admin.show', ['model' => $modelAlias]);
    }

    public function delete(string $modelAlias, int $id)
    {
        $model = $this->getModel($modelAlias);
        $amount = Cv::where($modelAlias, '=', $id)->get()->count();

        return view(
            'admin.delete',
            [
                'model' => $modelAlias,
                'change' => $model::all()->except([$id]),
                'id' => $id,
                'amount' => $amount
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

    private function change($modelAlias, $id, $newId)
    {
        $newModel = $this->getModel($modelAlias)::find($newId);
        $cvs = Cv::where($modelAlias, '=', $id)->get();
        foreach ($cvs as $cv) {
            $cv->$modelAlias = $newModel;
            $cv->save();
        }
    }
}
