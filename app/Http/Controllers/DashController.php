<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Position;
use App\Models\ProgrammingLevel;
use App\Models\Status;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function show(Request $request)
    {
        $query = Cv::limit(20);
        $positions = Position::all();
        $programming_levels = ProgrammingLevel::all();
        $statuses = Status::all();
        $filter = $request->session()->get('filter', collect([]));

        if ($request->has('positions')) {
            $filter = collect([]);
            $filter->put('positions', $request->input('positions'));
        }
        if ($request->has('levels')) {
            $filter = collect([]);
            $filter->put('levels', $request->input('levels'));
        }
        if ($request->has('statuses')) {
            $filter = collect([]);
            $filter->put('statuses', $request->input('statuses'));
        }
        if($request->input('dateFrom') != null && $request->input('dateTo') != null) {
            $query->whereBetween('date', [$request->input('dateFrom'), $request->input('dateTo')]);
        }
        if ($request->input('dateFrom') != null && $request->input('dateTo') == null) {
            $query->where('date', '>=', $request->input('dateFrom'));
        }
        if ($request->input('dateFrom') == null && $request->input('dateTo') != null) {
            $query->where('date', '<=', $request->input('dateTo'));
        }

        //var_dump($filter);
        $request->session()->put('filter', $filter);

        if ($filter->get('positions') != null) {
            $query->whereIn('position', $filter->get('positions'));
        }
        if ($filter->get('levels') != null) {
            $query->whereIn('programming_level', $filter->get('levels'));
        }
        if ($filter->get('statuses') != null) {
            $query->whereIn('status', $filter->get('statuses'));
        }
        //добавить сотрировку по имени
        if ($request->has('sort')) {
            $query->orderBy($request->input('sort'), $request->input('order'));
        }
        $sortOrder = $request->input('order') == 'desc' ? 'asc' : 'desc';
        $cvs = $query->get();
        return view('/dashboard', ['cvs' => $cvs,
                                        'positions' => $positions,
                                        'programming_levels' => $programming_levels,
                                        'statuses' => $statuses,
                                        'sort' => $sortOrder]);
    }
}
