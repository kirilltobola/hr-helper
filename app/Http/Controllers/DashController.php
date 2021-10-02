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
        $query = Cv::limit(10);

        $positions = Position::all();
        $programming_levels = ProgrammingLevel::all();
        $statuses = Status::all();

        //добавить фильтрацию по дате
        if ($request->has('positions'))
        {
            $query->whereIn('position', $request->input('positions'));
        }
        if ($request->has('levels'))
        {
            $query->whereIn('programming_level', $request->input('levels'));
        }
        if($request->has('statuses')){
            $query->whereIn('status', $request->input('statuses'));
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
