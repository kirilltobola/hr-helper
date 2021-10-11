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
        $cvs = Cv::query()->with(['status', 'position', 'level', 'candidate']);

        if ($request->has('sort')) {
            $cvs = $cvs->filter($filters)->sort($request->all());
        }else{
            session()->forget('filters');
            $filters = $request->all();
            session()->put('filters', $filters);
            $cvs = $cvs->filter($filters);
        }

        $cvs = $cvs->get();
        $sortOrder = $request->input('order') == 'desc' ? 'asc' : 'desc';

        return view('/dashboard', [
            'cvs' => $cvs,
            'positions' => Position::pluck('name', 'id'),
            'programming_levels' => ProgrammingLevel::pluck('name', 'id'),
            'statuses' => Status::pluck('name', 'id'),
            'sort' => $sortOrder]);
    }
}
