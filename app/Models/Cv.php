<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cv extends Model
{
    use HasFactory;

    protected $fillable = [
        'skills',
        'cv',
        'experience',
        'position',
        'programming_level',
        'date',
        'status'
    ];

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function getPositionAttribute($id){
        return Position::findOrFail($id);
    }

    public function getProgrammingLevelAttribute($id){
        return ProgrammingLevel::findOrFail($id);
    }

    public function getStatusAttribute($id){
        return Status::findOrFail($id);
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

    public function scopeFilter(Builder $builder, $filters = []) {
        if(!$filters){
            return $builder;
        }

        if($filters['dateFrom'] != null && $filters['dateTo'] != null) {
            $builder->whereBetween('date', [$filters['dateFrom'], $filters['dateTo']]);
        }
        if ($filters['dateFrom'] != null && $filters['dateTo'] == null) {
            $builder->where('date', '>=', $filters['dateFrom']);
        }
        if ($filters['dateFrom'] == null && $filters['dateTo'] != null) {
            $builder->where('date', '<=', $filters['dateTo']);
        }

        foreach($filters as $key => $filter) {
            $builder->when(in_array($key, $this->fillable), function ($q) use ($key, $filter) {
                return $q->whereIn($key, $filter);
            });
        }

        return $builder;
    }

    public function scopeSort(Builder $builder, $sort = []){

        $builder->when($sort['sort'] == 'name', function ($b) use ($sort){
            return $b->join('candidates', 'candidates.cv_id', '=', 'cvs.id')->orderBy('candidates.name', $sort['order']);
        });
        $builder->when($sort, function ($b) use ($builder, $sort) {
            return $b->orderBy($sort['sort'], $sort['order']);
        });

        return $builder;
    }
}
