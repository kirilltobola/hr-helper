<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvRequest;
use App\Models\Candidate;
use App\Models\Cv;
use App\Models\Position;
use App\Models\ProgrammingLevel;
use Illuminate\Support\Facades\App;

class CvController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('cv.create',[
            'levels' => ProgrammingLevel::pluck('name', 'id'),
            'positions' => Position::pluck('name', 'id')
        ]);
    }

    public function store(CvRequest $request)
    {
        $cv = new Cv();
        $cv->fill([
            'position_id' =>  $request->position,
            'programming_level_id' => $request->programming_level,
            'date' => $request->date,
            'skills' => $request->skills,
            'cv' => $request->cv,
            'experience' => $request->experience,
        ]);
        $cv->save();

        $candidate = new Candidate();
        $candidate->fill(['name'=> $request->name, 'email' => $request->email]);
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
                'positions' => Position::pluck('name', 'id'),
                'levels' => ProgrammingLevel::pluck('name', 'id'),
            ]
        );
    }

    public function update(CvRequest $request, Cv $cv)
    {
        $cv->fill([
            'position_id' =>  $request->position,
            'programming_level_id' => $request->programming_level,
            'date' => $request->date,
            'skills' => $request->skills,
            'cv' => $request->cv,
            'experience' => $request->experience,
        ]);
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

    public function save(Cv $cv)
    {
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML(view('cv.pdf', ['cv' => $cv]))->setPaper('a4');
        return $pdf->inline();
    }
}
