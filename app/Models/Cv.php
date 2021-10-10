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

    public function getPositionAttribute()
    {
        return Position::findOrFail($this->attributes['position']);
    }

    public function getProgrammingLevelAttribute()
    {
        return ProgrammingLevel::findOrFail($this->attributes['programming_level']);
    }

    public function getStatusAttribute()
    {
        return Status::findOrFail($this->attributes['status']);
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

    public function scopeFilter(Builder $builder, $filters = []) :Builder
    {
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

    public function scopeSort(Builder $builder, $sort = []) :Builder
    {
        $builder->when($sort['sort'] == 'name', function ($b) use ($sort){
            return $b->join('candidates', 'candidates.cv_id', '=', 'cvs.id')->orderBy('candidates.name', $sort['order']);
        });
        $builder->when($sort, function ($b) use ($builder, $sort) {
            return $b->orderBy($sort['sort'], $sort['order']);
        });

        return $builder;
    }
}
