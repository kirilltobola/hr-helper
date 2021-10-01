<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\ProgrammingLevel;
use App\Models\Status;

class Cv extends Model
{
    use HasFactory;

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function getPositionAttribute($id){
        return Position::findOrFail($id);
    }

    public function getProgrammingLevelAttribute($id){
        return ProgrammingLevel::find($id);
    }

    public function getStatusAttribute($id){
        return Status::find($id);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = $value->id;
    }

    public function setProgrammingLevelAttribute($value)
    {
        $this->attributes['programming_level'] = $value->id;
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value->id;
    }
}
