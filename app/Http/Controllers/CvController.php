<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Cv;
use App\Models\Position;
use App\Models\ProgrammingLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CvController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        $positions = Position::all();
        $levels = ProgrammingLevel::all();
        return view('cv.create',[
            'levels' => $levels,
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        $cv = new Cv();
        $cv->position = Position::find($request->position);
        $cv->programming_level = ProgrammingLevel::find($request->programming_level);
        $cv->date = $request->date;
        $cv->skills = $request->skills;
        $cv->cv = $request->cv;
        $cv->experience = $request->experience;;
        $cv->save();
        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->email = $request->email;
        $cv->candidate()->save($candidate);
        return redirect()->route('dashboard');
    }

    public function show(Cv $cv)
    {
        return view('cv.show', ["cv" => $cv]);
    }

    public function edit(Cv $cv)
    {
        return view(
            'cv.edit',
            [
                "cv" => $cv,
                'positions' => Position::all(),
                'levels' => ProgrammingLevel::all(),
            ]
        );
    }

    public function update(Request $request, Cv $cv)
    {
//        $request->validate([
//            'skills' => 'required',
//            'cv' => 'required',
//            'experience' => 'required',
//            'position' => 'required',
//            'programming_level' => 'required',
//            'date' => 'required',
//            'status' => 'required',
//        ]);
        $cv->position = Position::find($request->position);
        $cv->programming_level = ProgrammingLevel::find($request->programming_level);
        $cv->date = $request->date;
        $cv->skills = $request->skills;
        $cv->cv = $request->cv;
        $cv->experience = $request->experience;
        $cv->save();
        $candidate = $cv->candidate;
        $candidate->name = $request->name;
        $candidate->email = $request->email;
        $cv->candidate()->save($candidate);

        return redirect()->route('dashboard');
    }

    public function destroy(Cv $cv)
    {
        $cv->delete();
        return redirect()->route('dashboard');
    }

    public function save(Request $request, Cv $cv)
    {
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML(view('cv.pdf', ['cv' => $cv]))->setPaper('a4');
        return $pdf->inline();
    }
}
