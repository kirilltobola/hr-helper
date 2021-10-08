<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Cv;
use App\Models\Position;
use App\Models\ProgrammingLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function create()
    {
        $positions = \App\Models\Position::all();
        $levels =\App\Models\ProgrammingLevel::all();
        return view('cv_form',[
            'levels' => $levels,
            'positions' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show(Cv $cv)
    {
        return view('cv',["cv" => $cv]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function edit(Cv $cv)
    {
        return view('cv_form',["cv" => $cv]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cv $cv)
    {
        $validated = $request->validate([
            'skills' => 'required',
            'cv' => 'required',
            'experience' => 'required',
            'position' => 'required',
            'programming_level' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        $cv->fill($validated);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cv $cv)
    {
        $cv->delete();
        return redirect()->route('dashboard');
    }

    public function save(Request $request,Cv $cv){

        $pdf = \Illuminate\Support\Facades\App::make('snappy.pdf.wrapper');
        $pdf->loadHTML('<h1>HELLO WORLD</h1>');
        return $pdf->inline();
    }
}
