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
        $filters = session('filters', []);

        if($request->has('sort')) {
            $cvs = Cv::query()->filter($filters)->sort($request->all())->get();
        }else{
            session()->forget('filters');
            $filters = $request->all();
            session()->put('filters', $filters);
            $cvs = Cv::query()->filter($filters)->get();
        }

        $positions = Position::all();
        $programming_levels = ProgrammingLevel::all();
        $statuses = Status::all();
        $sortOrder = $request->input('order') == 'desc' ? 'asc' : 'desc';

        return view('/dashboard', ['cvs' => $cvs,
            'positions' => $positions,
            'programming_levels' => $programming_levels,
            'statuses' => $statuses,
            'sort' => $sortOrder]);
    }
}
